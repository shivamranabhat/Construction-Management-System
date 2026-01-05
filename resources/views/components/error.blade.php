@if(session()->has('error'))
<div class="flash fixed bg-white bottom-2 right-2 z-20 rounded-md" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
        style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <div class="success flex gap-2 p-4">
            <div class="icon">
                <div
                    class="rounded-full border border-gray-300 bg-red-200 flex items-center justify-center w-12 h-12 flex-shrink-0 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="rgb(185 28 28)" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>
            <div class="message">
                <div class="title">
                    <h5 class="text-base md:text-[1.125rem] lg:text-[1.125rem] xl:text-[1.125rem] font-bold">{{ session('error') }}</h5>
                </div>
                <div class="description">
                    <p class="text-sm text-brand-900 font-medium text-red-600">Oops! Something went wrong.</p>
                </div>
            </div>
        </div>
    </div>
@endif

