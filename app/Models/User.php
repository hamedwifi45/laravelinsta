<?php

namespace App\Models; // تعريف مساحة الأسماء للنموذج

// استخدام الصفوف المطلوبة من Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory; // استخدام خاصية إنشاء المصانع
use Illuminate\Foundation\Auth\User as Authenticatable; // استخدام نموذج المستخدم القابل للمصادقة
use Illuminate\Notifications\Notifiable; // استخدام خاصية الإشعارات
use Laravel\Sanctum\HasApiTokens; // استخدام خاصية الرموز المميزة لواجهة برمجة التطبيقات

class User extends Authenticatable // تعريف نموذج المستخدم
{
    use HasApiTokens, HasFactory, Notifiable; // استخدام الخصائص المحددة

    /**
     * الخصائص التي يمكن تعيينها بشكل جماعي.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // تعريف الخصائص القابلة للتعيين
        'name', // اسم المستخدم
        'username', // اسم المستخدم الفريد
        'bio', // السيرة الذاتية
        'privateaccont', // حالة الحساب الخاص
        'image', // صورة المستخدم
        'email', // البريد الإلكتروني
        'password', // كلمة المرور
        'description' // الوصف
    ];

    /**
     * الخصائص التي يجب إخفاؤها عند التسلسل.
     *
     * @var array<int, string>
     */
    protected $hidden = [ // تعريف الخصائص المخفية
        'password', // إخفاء كلمة المرور
        'remember_token', // إخفاء رمز التذكر
    ];

    /**
     * الخصائص التي يجب تحويلها.
     *
     * @var array<string, string>
     */
    protected $casts = [ // تعريف الخصائص التي تحتاج إلى تحويل
        'email_verified_at' => 'datetime', // تحويل تاريخ التحقق من البريد الإلكتروني إلى تاريخ ووقت
        'password' => 'hashed', // تحويل كلمة المرور إلى شكل مشفر
    ];

    public function posts(){ // دالة لاسترجاع المشاركات الخاصة بالمستخدم
        return $this->hasMany(Post::class); // علاقة واحد إلى متعدد مع نموذج المشاركات
    }

    public function commets(){ // دالة لاسترجاع التعليقات الخاصة بالمستخدم
        return $this->hasMany(Comnet::class); // علاقة واحد إلى متعدد مع نموذج التعليقات
    }

    public function sug_user(){ // دالة لاقتراح مستخدمين
        $following = auth()->user()->following()->wherePivot('confirm' , true)->get(); // استرجاع المستخدمين الذين يتابعهم المستخدم الحالي
        return User::all()->diff($following)->except(auth()->id())->shuffle()->take(10); // اقتراح 10 مستخدمين غير متابعين
    }

    public function likes(){ // دالة لاسترجاع الإعجابات الخاصة بالمستخدم
        return $this->belongsToMany(Post::class , 'likes'); // علاقة متعدد إلى متعدد مع نموذج المشاركات عبر جدول الإعجابات
    }

    public function following(){ // دالة لاسترجاع المستخدمين الذين يتابعهم المستخدم
        return $this->belongsToMany(User::class , 'follows' , 'user_id' , 'following_user_id')->withTimestamps()->withPivot('confirm'); // علاقة متعدد إلى متعدد مع نموذج المستخدمين عبر جدول المتابعات
    }

    public function followers(){ // دالة لاسترجاع المتابعين للمستخدم
        return $this->belongsToMany(User::class , 'follows'  , 'following_user_id' , 'user_id')->withTimestamps()->withPivot('confirm'); // علاقة متعدد إلى متعدد مع نموذج المستخدمين عبر جدول المتابعات
    }

    public function togle_follow(User $user){ // دالة لتبديل حالة المتابعة لمستخدم آخر
        $this->following()->toggle($user); // تبديل حالة المتابعة
        if(! $user->privateaccont){ // إذا لم يكن الحساب خاصًا
            return $this->following()->updateExistingPivot($user,['confirm' => true]); // تأكيد المتابعة
        }
    }

    public function follow(User $user){ // دالة لمتابعة مستخدم آخر
        if ($user->privateaccont) { // إذا كان الحساب خاصًا
            return $this->following()->attach($user ); // إضافة المستخدم إلى قائمة المتابعين
        }
        else{ // إذا لم يكن الحساب خاصًا
            return $this->following()->attach($user , ['confirm' => true]); // إضافة المستخدم مع تأكيد المتابعة
        }
        
    }

    public function unfollow(User $user){ // دالة لإلغاء متابعة مستخدم آخر
        return $this->following()->detach($user); // إزالة المستخدم من قائمة المتابعين
    }

    public function ispending (User $user){ // دالة للتحقق مما إذا كان هناك طلب متابعة معلق لمستخدم آخر
        return $this->following()->where('following_user_id' , $user->id)->where('confirm' , false)->exists(); // التحقق من وجود طلب متابعة غير مؤكد
    }   

    public function isfollowers(User $user){ // دالة للتحقق مما إذا كان المستخدم يتابع مستخدم آخر
        return $this->followers()->where('user_id' , $user->id)->where('confirm' , true)->exists(); // التحقق من وجود متابع مؤكد
    }

    public function isfollowing(User $user){ // دالة للتحقق مما إذا كان المستخدم يتابع مستخدم آخر
        return $this->following()->where('following_user_id' , $user->id)->where('confirm' , true)->exists(); // التحقق من وجود متابعة مؤكد
    }

    public function pending_followers(){ // دالة لاسترجاع المتابعين الذين لديهم طلبات متابعة مؤجلة
        return $this->followers()->where('confirm' , false); // استرجاع المتابعين الغير المؤكدين
    }
    public function deletefollowerRequset(User $user){
        $this->followers()->detach( $user );
    }
    public function confirm(User $user){
        return $this->followers()->updateExistingPivot($user , ['confirm' => true]);
    }

} // نهاية تعريف نموذج المستخدم