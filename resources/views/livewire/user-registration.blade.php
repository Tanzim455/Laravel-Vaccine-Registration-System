<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <!-- Form Elements: Inputs -->
    <div class="flex flex-col justify-center items-center">
        @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
          @endif
        <form wire:submit="save" class="space-y-6 dark:text-gray-100 xl:w-1/6 ">
            <!-- Text Input -->
            <div class="space-y-1">
              <label for="name" class="font-medium">Name</label>
              <input
                type="text"
                
                wire:model="name"
                placeholder="Enter your name"
                class="block w-full rounded-lg border border-gray-200 px-3 py-2 leading-6 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-blue-500"
              />
              @error('name')
              <div class="mt-1 text-red-500">{{ $message }}</div>
          @enderror
            </div> 
            <!-- END Text Input -->
          
            <!-- Email Input -->
            <div class="space-y-1">
              <label for="email" class="font-medium">Email</label>
              <input
                type="email"
                   wire:model="email"
                placeholder="Enter your email"
                class="block w-full rounded-lg border border-gray-200 px-3 py-2 leading-6 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-blue-500"
              />
              @error('email')
              <div class="mt-1 text-red-500">{{ $message }}</div>
          @enderror
            </div>
            <!-- END Email Input -->
          
            <!-- Phone Number  -->
            <div class="space-y-1">
                <label for="phone number" class="font-medium">Phone Number</label>
                <input
                  type="number"
                  wire:model="phone_number"
                  placeholder="Enter your phone number"
                  class="block w-full rounded-lg border border-gray-200 px-3 py-2 leading-6 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-blue-500"
                />
                @error('phone_number')
                <div class="mt-1 text-red-500">{{ $message }}</div>
            @enderror
              </div>
                  
              <div class="space-y-1">
                <label for="nid" class="font-medium">NID</label>
                <input
                  type="number"
                  wire:model="nid"
                  placeholder="Enter your nid"
                  class="block w-full rounded-lg border border-gray-200 px-3 py-2 leading-6 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-blue-500"
                />
                @error('nid')
                <div class="mt-1 text-red-500">{{ $message }}</div>
            @enderror
              </div>
            
            <!-- END Password Input -->
            <div class="space-y-1">
                
<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
<select wire:model="vaccine_centre_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Choose a country</option>
    @foreach ($vaccineCentres as $vaccineCentre)
        <option value="{{ $vaccineCentre->id }}">{{ $vaccineCentre->name }}</option>
    @endforeach
</select>
@error('vaccine_centre_id')
                <div class="mt-1 text-red-500">{{ $message }}</div>
            @enderror
    
  
  
</select>

            </div>  
            <button
    type="submit"
    class="inline-flex items-center justify-center space-x-2 rounded-lg border border-blue-700 bg-blue-700 px-3 py-2 text-sm font-semibold leading-5 text-white hover:border-blue-600 hover:bg-blue-600 hover:text-white focus:ring focus:ring-blue-400 focus:ring-opacity-50 active:border-blue-700 active:bg-blue-700 dark:focus:ring-blue-400 dark:focus:ring-opacity-90"
  >
    Submit
  </button>
  
          </form>
    </div>

</div>
