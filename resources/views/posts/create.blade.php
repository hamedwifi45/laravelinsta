<x-app-layout>
<div class="card m-10 p-10">
    <h1 class="text-3xl mb-10">{{__('create a new post')}}</h1>
    {{--Errors--}}
    <div class="flex flex-col justify-center items-center w-full">
        @if($errors->any())
            <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif
    </div>
    {{--forms--}}
    <form action="/p/create" method="post" class="w-full" enctype="multipart/form-data">
    @csrf
        <input type="file" name="image" id="file-input" 
            class="w-full border border-gray-200  bg-gray-300 block focus:outline-none rounded-xl" id="">
            <p class="mt-2.5 text-sm text-gray-700 dark:text-gray-500" id="file_input_help">PNG, JPG or GIF.</p>





            <textarea name="description" class="mt-10 w-full border border-gray-200 rounded-xl" placeholder="{{__('Write a description')}}"  rows="5"></textarea>
            <x-primary-button class="mt-4">{{__("Create Post")}}</x-primary-button>   
    
        </form>
</div>


</x-app-layout>