<div id="showWifiPassword" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center justify-between">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-8 mr-3" alt="">
                    <h3 class="text-xl font-medium text-white">
                        (Nombre de SSID)
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="showWifiPassword">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="p-4 bg-white grid grid-cols-1 gap-2 rounded-b">

                <div class="flex items-center">
                    <label for="Contraseña" class="flex items-center block text-sm font-medium text-gray-900">
                        Contraseña:
                    </label>
                    <p class="text-sm font-semibold ml-1">(Contraseña)</p>
                </div>
                <hr class="mt-2 border-gray-300">
                <div class="">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#clock" />
                            </svg>
                            <p class="text-xs text-gray-500 font-semibold">Fecha de Creación: DD/MM/AAAA</p>
                        </div>
                        <span class="text-gray-500 mx-1">/</span>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#clockArrow" />
                            </svg>
                            <p class="text-xs text-gray-500 font-semibold">Fecha de Actualización: DD/MM/AAAA</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <!-- <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
            </div> -->
        </div>
    </div>
</div>