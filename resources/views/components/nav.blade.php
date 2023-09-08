<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
            //   laravel: '#38B6FF #B3B3CC #113F67',
              laravel: '#666699',
            },
          },
        },
      }
  </script>
  <title>MicroGigs | Find software Jobs & Projects</title>
</head>

<body class="mb-16 bg-gray-300">
  <nav class=" top-0 left-0 flex justify-between items-center mb-4 z-10 w-full bg-gray-300 border-b-4 border-[#113F67]">
    <a href="/admin"><img class="w-14 p-2" src="{{asset('images/logoM.png')}}" alt="" class="logo" /></a>

    
    <ul class="flex space-x-6 mr-6 text-md">
      @auth
      <li>
        <span class="font-bold uppercase">
          Welcome {{auth()->user()->name}}
        </span>
      </li>
      <li>
        <a href="/admin/auth/manage" class=" text-black hover:text-laravel"><i class="fa fa-address-book" aria-hidden="true"></i>
          Manage Users</a>

      </li>
      <li>
        <a href="/admin/listings/create" class=" text-black hover:text-laravel"><i class="fa fa-laptop" aria-hidden="true"></i>
        </i>
          Post Job</a>

      </li>
      <li>
        <a href="/admin/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
      </li>
      <li>
        <a href="/admin/auth/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
      </li>
      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit">
            <i class="fa-solid fa-door-closed"></i> Logout
          </button>
        </form>
      </li>
      @else
      <li>
        <a href="/admin/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
      </li>
      @endauth
    </ul>
  </nav>

  <main>
    {{$slot}} 
  </main>
  <footer
    class="fixed bottom-0 left-0 w-full  items-center font-bold bg-laravel text-white h-auto mt-24 opacity-90 md:justify-center">
    <p class="py-2 text-center">Copyright &copy; 2023, All Rights reserved ADMIN</p>

  </footer>

  <x-flash-message />
</body>

</html>