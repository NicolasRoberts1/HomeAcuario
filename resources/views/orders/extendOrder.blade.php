<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            @auth
            <h2 class="mb-4 px-2 text-black font-bold text-xl">
                Pedido
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                  <thead class="bg-gray-200">
                    <tr>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">ID Pedido</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Fecha</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Cliente</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Dirección</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Pago</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Total ($)</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Pre entrega</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Observación</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Estado</th>
                    </tr>
                  </thead>
                       <tbody class="border border-gray-400">
                           <tr class="">
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->id}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->fecha}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->cliente}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center break-words">{{$order->direccion}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->pago}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->total}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->pre_entrega}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->observacion}}</td>
                               <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center text-orange-400" @if($order->estado == 'Listo')class="text-green-400" @endif>{{$order->estado}}</td>
                           </tr>
                       </tbody>
                </table>
            </div>
            {{--PRODUCTOS ASOCIADOS AL PEDIDO--}}
            <h2 class="mb-4 mt-8 px-2 text-black font-bold text-xl">
                Productos asociados al pedido
            </h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 min-w-full table-auto">
                  <thead class="bg-gray-200">
                    <tr>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">ID Producto</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Imagen</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Nombre</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Precio ($)</th>
                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody class="border border-gray-400">
                      @foreach($products as $product)
                      <tr>
                          <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->id}}</td>
                          <td class="py-2 px-4 border-b text-sm text-gray-700 text-center items-center">
                            @if($product->imagen)
                                <img src="{{ asset('storage/' . $product->imagen) }}" alt="Imagen de {{ $product->nombre }}" class="w-16 h-16 object-cover">
                            @else
                                No image
                            @endif
                            </td>
                          <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->nombre}}</td>
                          <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">
                            @if($order->tipo == 'minorista')
                                {{$product->precio_minorista}}
                            @endif
                            @if($order->tipo == 'mayorista')
                                {{$product->precio_mayorista}}
                            @endif
                        </td>
                          <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->pivot->cantidad}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>

            <div class="flex mb-4 mt-8 px-2 justify-center gap-16">
                <div class="flex items-center gap-3">
                    <h3 class="text-black font-bold text-xl">
                        Pre Entrega:
                    </h3>
                    <p>{{$order->pre_entrega}}</p>
                </div>
                <div class="flex items-center gap-3">
                    <h3 class="text-black font-bold text-xl">
                        Total:
                    </h3>
                    <p>{{$order->total}}</p>
                </div>
                <div class="flex items-center gap-3">
                    <h3 class="text-black font-bold text-xl">
                        Total a pagar:
                    </h3>
                    <p>{{$order->total - $order->pre_entrega}}</p>
                </div>
            </div>
            <div class="flex justify-center">
                <a href="{{route('orders')}}" class="font-medium text-lg text-white button cursor-pointer bg-indigo-600 rounded-lg px-4 py-3 text-center hover:bg-indigo-800 ml-5 mt-5 justify-center">Volver</a>
            </div>
            @endauth
        </div>
    </div>
</x-app-layout>
