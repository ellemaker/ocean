<div>
    <nav class="bg-indigo-500 shadow py-6">
	    <div class="container mx-auto px-6 md:px-0">
	        <div class="flex items-center justify-center">
	            <div class="mr-6">
	                <a href="{{ url('/') }}" class="text-xl font-medium tracking-widest text-gray-100 no-underline">
	                    Ocean
	                </a>
	            </div>
	            @auth
		            <div class="flex-1">
		                <ul class="text-white flex items-center">
		                    <li><a href="/home" class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600">Dashboard</a></li>
		                    <li class="relative" x-data="{openOption: false}">
		                    	<a 
		                    		@click="openOption = !openOption" 
		                    		href="javascript:;" 
		                    		:class="{ 'bg-indigo-600': openOption }"
		                    		class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600">Content</a>
	                               
	                            <div x-show="openOption"
	                                 x-transition:enter="transition ease-out duration-200" 
	                                 x-transition:enter-start="opacity-0 translate-y-1" 
	                                 x-transition:enter-end="opacity-100 translate-y-0" 
	                                 x-transition:leave="transition ease-in duration-150" 
	                                 x-transition:leave-start="transform opacity-100 scale-100" 
	                                 x-transition:leave-end="opacity-100 translate-y-0"
	                                 @click.away="openOption = false"
	                                 class="absolute left-1/2 transform -translate-x-1/2 lg:left-1/2 mt-3 px-2 w-48 sm:px-0" style="display: none">
	                                <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
	                                    <a href="{{ route('admin.page.index') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Pages</a>
	                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Blog</a>
	                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Templates</a>
	                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Content Holder</a>
	                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Menu</a>
	                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Forms</a>
	                                </div>
	                            </div>
		                    </li>
		                    <li>
		                    	<a href="{{ route('admin.media.index') }}" class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600  @if (Route::currentRouteName() === 'admin.media.index') bg-indigo-600 @endif">Media</a>
		                    </li>
		                    <li><a href="#" class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600">Web Apps</a></li>
		                    <li><a href="#" class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600">CRM</a></li>
		                    <li><a href="#" class="block py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-600">Store</a></li>
		                </ul>
		            </div>
	            @endauth

	            
	            <div class="text-right ml-auto">
	                <div class="flex items-center">
	                    @guest
	                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
	                        @if (Route::has('register'))
	                            <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
	                        @endif
	                    @else

	                    	@if ( Route::is('home'))
	                    		<div>
		                            <div class="relative" x-data="{openOption: false}">
		                                <button class="field-move mx-3 bg-green-400 text-white font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-green-400" @click="openOption = !openOption">Create New</button>

		                                <div x-show="openOption"
		                                     x-transition:enter="transition ease-out duration-100" 
		                                     x-transition:enter-start="transform opacity-0 scale-95" 
		                                     x-transition:enter-end="transform opacity-100 scale-100" 
		                                     x-transition:leave="transition ease-in duration-75" 
		                                     x-transition:leave-start="transform opacity-100 scale-100" 
		                                     x-transition:leave-end="transform opacity-0 scale-95"
		                                     @click.away="openOption = false"
		                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg text-left outline-none" style="display:none">
		                                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
		                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Page</a>
		                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Post</a>
		                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Form</a>
		                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Product</a>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                    	@endif
	                        


	                        <div class="">
	                            
	                            <div class="relative" x-data="{openOption: false}">
	                                <button @click="openOption = !openOption" class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid" id="user-menu" aria-label="User menu" aria-haspopup="true">
	                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
	                                </button>
	                                <div x-show="openOption"
	                                     x-transition:enter="transition ease-out duration-100" 
	                                     x-transition:enter-start="transform opacity-0 scale-95" 
	                                     x-transition:enter-end="transform opacity-100 scale-100" 
	                                     x-transition:leave="transition ease-in duration-75" 
	                                     x-transition:leave-start="transform opacity-100 scale-100" 
	                                     x-transition:leave-end="transform opacity-0 scale-95"
	                                     @click.away="openOption = false"
	                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg text-left" style="display: none">
	                                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
	                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
	                                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
	                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
	                            {{ csrf_field() }}
	                        </form>
	                    @endguest
	                </div>
	            </div>
	        </div>
	    </div>
	</nav>
</div>