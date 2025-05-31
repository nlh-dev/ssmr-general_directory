<?php
// Configuración dinámica del sidebar
$sidebarMenu = [
    [
        'label' => 'Inicio',
        'icon' => 'home',
        'url' => $routes['dashboard'],
    ],
    [
        'label' => 'Contraseñas',
        'icon' => 'lockFile',
        'submenu' => [
            [
                'label' => 'Directorio',
                'url' => $routes['wifiList'],
            ],
        ],
        'dropdownId' => 'password-dropdown',
    ],
    [
        'label' => 'Conexiones',
        'icon' => 'rightArrow',
        'submenu' => [
            ['label' => 'Puertos', 'url' => '#'],
            ['label' => 'Switches', 'url' => '#'],
        ],
        'dropdownId' => 'conections-dropdown',
    ],
    [
        'label' => 'Dispositivos',
        'icon' => 'clipBoard',
        'submenu' => [
            ['label' => 'Control de Entrega', 'url' => $routes['deviceDeliveryList']],
            ['label' => 'Historial', 'url' => $routes['deviceHistoryList']],
            ['label' => 'Observaciones', 'url' => $routes['deviceObservationsList']],
        ],
        'dropdownId' => 'devices-dropdown',
    ],
    [
        'label' => 'Inventario',
        'icon' => 'fileStorage',
        'submenu' => [
            ['label' => 'Existencias', 'url' => '#'],
            ['label' => 'Categorias', 'url' => '#'],
            ['label' => 'Movimientos', 'url' => '#'],
            ['label' => 'Historial', 'url' => '#'],
        ],
        'dropdownId' => 'storage-dropdown',
    ],
    'separator',
    [
        'label' => 'Ubicaciones',
        'icon' => 'tagLocation',
        'url' => $routes['locationsList'],
    ],
    [
        'label' => 'Departamentos',
        'icon' => 'departments',
        'url' => $routes['departmentsList'] . '/',
    ],
    'separator',
    [
        'label' => 'Usuarios',
        'icon' => 'users',
        'url' => '#',
    ],
    [
        'label' => 'Permisos',
        'icon' => 'users',
        'url' => '#',
    ],
];
?>
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
            <?php foreach ($sidebarMenu as $item): ?>
                <?php if ($item === 'separator'): ?>
                    <hr class="text-gray-700">
                <?php elseif (isset($item['submenu'])): ?>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="<?= $item['dropdownId'] ?>" data-collapse-toggle="<?= $item['dropdownId'] ?>">
                            <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#<?= $item['icon'] ?>" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"><?= $item['label'] ?></span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="<?= $item['dropdownId'] ?>" class="hidden py-2 space-y-2">
                            <?php foreach ($item['submenu'] as $subitem): ?>
                                <li>
                                    <a href="<?= $subitem['url'] ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><?= $subitem['label'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $item['url'] ?>" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 transition duration-100">
                            <svg class="shrink-0 w-6 h-6 transition duration-75 text-gray-400 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#<?= $item['icon'] ?>" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap"><?= $item['label'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
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