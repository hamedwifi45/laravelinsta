
    @csrf
        <input type="file" name="image" id="file-input" value="{{$post->image ?? ""}}"
            class="w-full border border-gray-200  bg-gray-300 block focus:outline-none rounded-xl" id="">
            <p class="mt-2.5 text-sm text-gray-700 dark:text-gray-500" id="file_input_help">PNG, JPG or GIF.</p>





            <textarea name="description" 
             class="mt-10 w-full border border-gray-200 rounded-xl"
              placeholder="{{__('Write a description')}}"  rows="5">{{$post->description ?? ""}}</textarea>
               
    

