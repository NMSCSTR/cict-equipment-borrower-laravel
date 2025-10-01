@extends("components.default")

@section("title", "Welcome - CICT Equipment Borrower System")

@section("content")
<section class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="grid w-full h-full px-4 py-8 mx-auto gap-8 lg:py-16 lg:grid-cols-12 items-center justify-center">
        <div class="mx-auto place-self-center lg:col-span-7 flex flex-col items-center text-center">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
               CICT EQUIPMENT BORROWER SYSTEM
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-900 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                From checkout to global sales tax compliance, companies around the world use Flowbite to simplify their payment stack.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-black rounded-lg bg-white border border-black hover:bg-black hover:text-white focus:ring-4 focus:ring-primary-300 dark:bg-white dark:text-black dark:border-white dark:hover:bg-black dark:hover:text-white dark:focus:ring-primary-900 transition-colors">
                    Login to system
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                {{-- <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-black border border-black rounded-lg hover:bg-white hover:text-black focus:ring-4 focus:ring-gray-100 dark:text-black dark:bg-white dark:border-white dark:hover:bg-black dark:hover:text-white dark:focus:ring-gray-800 transition-colors">
                    Speak to Sales
                </a> --}}
            </div>
        </div>
        <div class="mx-auto lg:mt-0 lg:col-span-5 lg:flex justify-center items-center">
            <img class="w-full h-auto max-h-[500px] object-contain" src="https://www.nmsc.edu.ph/application/files/9117/2319/6158/CICT_LOGO.png" alt="mockup">
        </div>
    </div>
</section>
@endsection
