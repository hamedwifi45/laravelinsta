<x-app-layout>
<form class="bg-white p-5 rounded-sm" method="POST" action="/{{$user->username}}/update" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="space-y-12">
      <div class="border-b border-blue-500/10 pb-12">
        <h2 class="text-base/7 font-semibold text-blue-500">Profile</h2>
        {{-- <p class="mt-1 text-sm/6 text-gray-600">{{__(This information will be displayed publicly so be careful what you share.)}}</p> --}}
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="username" class="block text-sm/6 font-medium text-blue-500">{{__("Username")}}</label>
            
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="username" id="username" autocomplete="username" 
                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-blue-500 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                 value="{{$user->username}}">
              </div>
              @error('username')
              <div class="bg-gray-300 text-sm text-600-red mt-3">{{$message}}</div>
            @enderror
            </div>
          </div>
  
          <div class="col-span-full">
            <label for="bio" class="block text-sm/6 font-medium text-blue-500">{{__("Bio")}}</label>
            <div class="mt-2">
              <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">{{ $user->bio}}</textarea>
            </div>
            <p class="mt-3 text-sm/6 text-gray-600">{{__("Write a few sentences about yourself.")}}</p>
          </div>
  
          <div class="col-span-full">
            <label for="photo" class="block text-sm/6 font-medium text-blue-500">{{__("Photo")}}</label>
            <div class="mt-2 flex items-center gap-x-3">
              <img src="{{ $user->image }}" class="rounded-full h-15 w-15" alt="" srcset="">

              <input type="file" name="image" id="file-input" value="{{$post->image ?? ""}}"
              class="w-full border border-gray-200  bg-gray-100 block focus:outline-none rounded-xl" id="">
  
            </div>
          </div>
  
          {{-- <div class="col-span-full">
            كفر خاصية تجريبةي لتجربة فيما بعد
            <label for="cover-photo" class="block text-sm/6 font-medium text-blue-500">Cover photo</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-blue-500/25 px-6 py-10">
              <div class="text-center">
                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm/6 text-gray-600">
                  <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>Upload a file</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
  
      <div class="border-b border-blue-500/10 pb-12">
        <h2 class="text-base/7 font-semibold text-blue-500">{{__("personal info")}}</h2>
        {{-- <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p> --}}
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="first-name" class="block text-sm/6 font-medium text-blue-500">{{__("First name")}}</label>
            <div class="mt-2">
              <input type="text" name="name" id="first-name" value="{{$user->name}}" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-blue-500">{{__("Last name")}}</label>
            <div class="mt-2">
              <input type="text" name="username" id="last-name" value="{{$user->username}}" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
          </div>
  
          <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-blue-500">{{__("Email address")}}</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" value="{{$user->email}}" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="password" class="block text-sm/6 font-medium text-blue-500">{{__("password")}}</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
          </div>
          <div class="sm:col-span-3">
            <label for="password-confirmation" class="block text-sm/6 font-medium text-blue-500">{{__("password confirmation")}}</label>
            <div class="mt-2">
              <input id="password-confirmation" name="password-confirmation" type="password" autocomplete="password-confirmation" class="block w-full rounded-md border-0 py-1.5 text-blue-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
          </div>

  
          </div>
        </div>
      </div>
  
      <div class="border-b border-blue-500/10 pb-12">
        <div class="mt-10 space-y-10">
          
          <fieldset>
            <legend class="text-sm/6 font-semibold text-blue-500">تفعيل وضع الخصوصية</legend>
            {{-- <p class="mt-1 text-sm/6 text-gray-600">These are delivered via SMS to your mobile phone.</p> --}}
            <div class="mt-6 space-y-6">
              <div class="flex items-center gap-x-3">
                <input id="noprivate" name="noprivate" {{$user->privateaccont? "checked" : ""}} type="checkbox" class="size-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                <label for="noprivate" class="block text-sm/6 font-extrabold text-blue-500">في حال التفعيل لن يسطتيع احد رؤية منشوراتك الا عند طلب متابعتك</label>
              </div>
              
            </div>
          </fieldset>
        </div>
      </div>
    
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm/6 font-semibold text-blue-500">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </div>
  </form>
</x-app-layout>