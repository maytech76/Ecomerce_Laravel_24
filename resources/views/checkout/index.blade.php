<x-app-layout>

    <div class="-mb-16 text-gray-700" x-data="{ pago: 1}">

          <div class="grid grid-cols-1 lg:grid-cols-2">

             <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="text-2xl font-semibold mb-4">
                        Pago
                    </h1>
                    <div class="shadow rounded-lg overflow-hidden border border-gray-200">

                       <ul class="divide-y divide-gray-300">

                           <li>
                              <label class="p-4 flex items-center">

                                   <input type="radio" value="1" x-model="pago">

                                    <span class="ml-2">
                                        Tarjeta Debito / Credito
                                    </span>

                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png">

                              </label>

                              <div class="p-4 bg-gray-100 text-center border border-t-gray-400" x-show="pago == 1">
                                   <i class="fa-regular fa-credit-card text-8xl"></i>
                                   
                                   <p class="text-center px-4 pb-2">Luego de hacer click en "Pagar ahora",
                                       Se abrira una ventana para completar compra de forma segura</p>
                                    </div>

                           </li>                   
                            <li>                             
                                <label class="p-4 flex items-center">
                                     <input type="radio" value="2" x-model="pago">
                                        <span class="ml-2">
                                            Deposito Bancario / Transferencias Bancarias
                                        </span>
                                </label>    
                                <div class="p-4 bg-gray-100 flex justify-center items-center border border-t-gray-400" x-cloak x-show="pago == 2">
                                    <div class="">
                                        <p>1 - Banco A : 1987-98765432-111</p>
                                        <p>2 - Banco B : 1987-98765432-222</p>
                                        <p>3 - Banco C : 1987-98765432-333</p>
                                        <p>  - Razón Social: Ecommerce SPA</p>
                                        <p>  - RUT: 789456123-2 </p>
                                        <p>  - ENVIAR COMPROBANTE A: admin@ecommerce.com </p>
                                    </div>
                                </div>                         
                            </li>
                       </ul>
                    </div>
                </div>
             </div>

             <div class="col-span-1 bg-gray-200">
                 <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit nemo corporis enim ipsa excepturi maxime incidunt explicabo! Quis laudantium autem odio molestiae obcaecati harum, accusantium unde, similique corporis consec</p>
                 </div>
             </div>

             

          </div>
    </div>

</x-app-layout>