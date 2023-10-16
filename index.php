<?php
    require_once 'database/Database.php';

    $connection = new \database\Database('localhost', 'csrf', 'root', '');

    $connection = $connection->getConnection();

    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL Injection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer components {
            .transition-base {
                @apply transition-all ease-in-out delay-200 placeholder:transition-all placeholder:ease-in-out placeholder:delay-200;
            }

            .header__link {
                @apply border-b border-transparent  hover:border-white pb-1;
            }

            .button {
                @apply flex items-center justify-center px-8 py-3 border rounded transition-all delay-100 font-medium;
            }

            .form-button {
                @apply bg-purple-500;
            }

            .button_hover-fill {
                @apply bg-transparent border-white hover:bg-white hover:text-slate-950;
            }

            .button_hover-outline {
                @apply bg-white border-white hover:bg-transparent hover:border hover:text-white;
            }

            .input {
                @apply w-96 outline-0 border border-white bg-transparent text-white rounded px-8 py-3;
            }

            .placeholder-transition {
                @apply placeholder:text-white/75 px-4 focus:placeholder:text-transparent
            }

            .post-el {
                @apply flex basis-1/4 flex-col border border-white rounded;
                flex-basis: 23.8%;
            }

            .absolute-center {
                @apply absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2;
            }

            .flex-x-center {
                @apply flex flex-col items-center;
            }


        }

        .select_active {
            @apply text-white;
        }
    </style>
</head>
<body class="font-sans h-screen bg-gradient-to-tl bg-slate-800 text-slate-50 from-green-300/10 via-blue-500/80 to-purple-600/80">
    <main class="flex-auto border-b border-indigo-100/50 backdrop-opacity-50 py-52">
        <h1 class="text-5xl text-center">Login</h1>
        <?php
            if(isset($_SESSION['user'])) {?>
                <form class="flex flex-wrap gap-7 items-start justify-center mt-10" action="actions/logout.php" method="post">
                    <button class="button form-button button_hover-outline text-slate-800 items-start h-full" type="submit">Logout</button>
                </form>
            <?php } else {?>
                <form class="flex flex-col items-center flex-wrap gap-7 justify-center mt-10" action="actions/login.php" method="post">
                    <?php
                    if(isset($_SESSION['attempt'])) {?>
                        <div class="flex flex-col gap-3 w-96 text-center">
                            <?php
                                echo $_SESSION['attempt'];
                                unset($_SESSION['attempt']);
                            ?>
                        </div>
                    <?php }
                    ?>
                    <div class="flex flex-col gap-3 w-96">
                        <input class="input transition-base placeholder-transition" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="flex flex-col gap-3 w-96">
                        <input class="input transition-base placeholder-transition" type="text" name="password" placeholder="Password">
                    </div>
                    <button class="button form-button button_hover-outline text-slate-800 items-start h-full" type="submit">Login</button>
                </form>
            <?php }
        ?>
    </main>
</body>
</html>