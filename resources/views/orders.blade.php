<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
                    @if($notify_order_created == true)
                        <div class="alert bg-green-300 mb-8 p-4 border-2 border-solid border-green-500 rounded-lg" role="alert"><!--alert alert-success mt-4 mb-4-->
                            El pedido se ha agregado correctamente!
                        </div>
                    @endif

                    @if($notify_order_updated == true)
                        <div class="alert bg-green-300 mb-8 p-4 border-2 border-solid border-green-500 rounded-lg" role="alert"><!--alert alert-success mt-4 mb-4-->
                            El pedido se ha actualizado!
                        </div>
                    @endif

                    @if($notify_order_deleted == true)
                        <div class="alert bg-red-300 mb-8 p-4 border-2 border-solid border-red-500 rounded-lg" role="alert"><!--alert alert-danger mt-4 mb-4-->
                            El pedido ha sido eliminado!
                        </div>
                    @endif

                        <div class="px-4 py-4 flex justify-center mb-7">
                            <a href="{{route('orders.create')}}" class="button cursor-pointer bg-indigo-600 text-white rounded-lg px-4 py-3 text-center font-weight-500 hover:bg-indigo-800" id="btnAdd">+ Añadir</a>
                        </div>
                    @auth
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
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Productos</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Acción</th>
                                </tr>
                              </thead>
                                   <tbody class="border border-gray-400">
                                       @foreach( $orders as $order )
                                       <tr class="">
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->id}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->fecha}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->cliente}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center break-words">{{$order->direccion}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->pago}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->total}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->pre_entrega}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$order->observacion}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center text-orange-400">{{$order->estado}}</td>
                                           <td class="py-2 px-4 border-b text-sm text-gray-700 text-center"><a href="{{route('orders.extendOrder', ['order'=>$order->id])}}" class="flex justify-center"><img src="{{asset('images/blue-plus.ico')}}" alt="Ver productos" style="width: 20px;"></a></td>
                                           <td class="flex py-2 justify-between py-2 px-4 border-b text-sm text-gray-700 text-center">
                                               <button type="button" onclick="openModal('{{ $order->id }}')"><img src="{{asset('images/bassurero.ico')}}" alt="Eliminar" style="width: 20px;"></button>
                                               <a href="#" style="width: 20px;"><img src="{{asset('images/check-icon.ico')}}" alt="Listo"></a>
                                           </td>
                                       </tr>

                                       <!-- Modal -->
                                       <div id="deleteModal{{ $order->id }}" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                            <span class="close text-gray-500 hover:text-gray-700 text-xl cursor-pointer float-right" onclick="closeModal('{{ $order->id }}')">&times;</span>
                                            <p class="text-lg font-semibold mb-4">¿Estás seguro de que deseas eliminar este producto?</p>
                                            <form id="deleteForm{{ $order->id }}" action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex justify-end space-x-3">
                                                    <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600">
                                                        Eliminar
                                                    </button>
                                                    <button type="button" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-300" onclick="closeModal('{{ $order->id }}')">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                   @endforeach
                                   </tbody>
                            </table>
                        </div>

                    @endauth
        </div>
    </div>
    <script>
        function openModal(orderId) {
            document.getElementById("deleteModal" + orderId).style.display = "block";
        }

        function closeModal(orderId) {
            document.getElementById("deleteModal" + orderId).style.display = "none";
        }
    </script>
</x-app-layout>

