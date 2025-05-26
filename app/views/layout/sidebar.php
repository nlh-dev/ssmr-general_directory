<!-- NAVBAR -->
<nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-gray-900 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <!-- Botón para ocultar/mostrar sidebar en desktop -->
                <button id="sidebar-toggle" type="button" class="hidden sm:inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Toggle sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ms-2 md:me-24">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-8 me-3" alt="SSMR LOGO" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Directorio General</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                Neil Sims
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                neil.sims@flowbite.com
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-900 border-r border-gray-200 sm:translate-x-0 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 font-medium">
            <!-- INICIO -->
            <li class="">
                <a href="<?= $routes['dashboard'] ?>" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 transition duration-100">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#home" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Inicio</span>
                </a>
            </li>

            <!-- CONTRASEÑAS -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="password-dropdown" data-collapse-toggle="password-dropdown">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Contraseñas</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="password-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="<?= $routes['wifiList'] ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Directorio</a>
                    </li>
                </ul>
            </li>

            <!-- CONEXIONES -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="conections-dropdown" data-collapse-toggle="conections-dropdown">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#rightArrow" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Conexiones</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="conections-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            Puertos
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            Switches
                        </a>
                    </li>
                </ul>
            </li>

            <!-- CONTROL DE ENTREGA -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="devices-dropdown" data-collapse-toggle="devices-dropdown">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#clipBoard" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Dispositivos</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="devices-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="<?= $routes['deviceDeliveryList']?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Control de Entrega</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Historial
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Observaciones</a>
                    </li>
                </ul>
            </li>

            <!-- INVENTARIO -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="storage-dropdown" data-collapse-toggle="storage-dropdown">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#fileStorage" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Inventario</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="storage-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Existencias</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Categorias
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Movimientos</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Historial</a>
                    </li>
                </ul>
            </li>

            <!-- SEPARADOR -->
            <hr class="text-gray-700">

            <!-- UBICACIONES -->
            <li>
                <a href="<?= $routes['locationsList'] ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Ubicaciones</span>
                </a>
            </li>

            <!-- DEPARTAMENTOS -->
            <li>
                <a href="<?= $routes['departmentsList'] ?>/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Departamentos</span>
                </a>
            </li>

            <hr class="text-gray-700">
            
            <!-- USUARIOS -->
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#users" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
                </a>
            </li>
            <!-- ROLES -->
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#users" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Permisos</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- USER INFO FOOTER -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-800 text-white">
        <div class="flex items-center">
            <span class="">Bienvenido(a):<br>
                <p class="font-medium uppercase">
                    Usuario
                </p>
            </span>
        </div>
    </div>
</aside>

<!-- HIDE SIDEBAR FUNCTION -->
<script src="<?= APP_URL ?>app/assets/js/SidebarToggle.js"></script>