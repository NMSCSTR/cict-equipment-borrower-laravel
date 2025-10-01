@extends('components.default')
@section("title", "Register - CICT Equipment Borrower System")
@section("content")
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="https://www.nmsc.edu.ph/application/files/9117/2319/6158/CICT_LOGO.png" alt="logo">
          CICT Borrower System
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-lg xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
              </h1>
              <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09XXXXXXXXX">
                </div>
                <div>
                    <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
                    <select name="user_type" id="user_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="" disabled selected>Select user type</option>
                        <option value="admin">Admin</option>
                        <option value="instructor">Instructor</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                    </div>
                </div>
                <button type="submit" class="w-full text-white bg-black hover:bg-white hover:text-black border border-black focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-black dark:hover:bg-white dark:hover:text-black dark:focus:ring-gray-800 transition-colors">Create an account</button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                </p>
            </form>
          </div>
      </div>
  </div>
</section>
@endsection

