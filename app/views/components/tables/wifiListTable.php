<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-900 text-white">
                <tr class="">
                    <th scope="col" class="px-5 py-3">
                        #
                    </th>
                    <th scope="col" class="px-5 py-3">
                        SSID
                    </th>
                    <th scope="col" class="px-5 py-3">
                        Contraseña
                    </th>
                    <th scope="col" class="px-5 py-3">
                        Ubicación
                    </th>
                    <th scope="col" class="px-5 py-3">
                        Departamento
                    </th>
                    <th scope="col" class="px-5 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-5 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white text-gray-800 border-gray-200 hover:bg-gray-200 transition duration-100">
                    <td class="px-5 py-2 whitespace-nowrap">
                        <p class="text-xs text-gray-400">
                            1
                    </td>
                    <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                        <p class="text-xs">
                            GERENCIA MEDICA
                        </p>
                        <div class="flex items-center mt-1 whitespace-nowrap">
                            <span class="flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-gray-900 hover:text-white transition duration-100">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                                </svg>
                                192.168.10.162
                            </span>
                        </div>
                    </td>
                    <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <button class="flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                    </svg>
                                    Ver
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                                <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                </svg>
                                Piso 1, Lado A
                            </span>
                        </div>
                    </td>
                    <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-800 hover:text-white transition duration-100">
                                <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                </svg>
                                Gerencia Medica
                            </span>
                        </div>
                    </td>
                    <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                            <p class="font-semibold text-green-500">
                                Habilitado
                            </p>
                        </div>
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-red-700 me-2"></div>
                            <p class="font-semibold text-red-700">
                                Deshabilitado
                            </p>
                        </div>
                    </td>
                    <td class="items-center px-5 py-2 text-right whitespace-nowrap">
                        <div class="flex items-center space-x-1">
                            <div class="flex items-center">
                                <button class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center">
                                <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                    </svg>
                                </button>
                            </div>
                            <form action="" class="AjaxForm">
                                <div class="flex items-center">
                                    <button type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>