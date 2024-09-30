<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8"><!--class="row"-->
                    @auth
                        @if($notify_product_created == true)
                            <div class="alert bg-green-300 mb-8 p-4 border-2 border-solid border-green-500 rounded-lg" role="alert">
                                El producto se ha agregado correctamente!
                            </div>
                        @endif

                        @if($notify_product_updated == true)
                            <div class="alert bg-green-300 mb-8 p-4 border-2 border-solid border-green-500 rounded-lg" role="alert">
                                El producto se ha actualizado correctamente!
                            </div>
                        @endif

                        @if($notify_product_deleted == true)
                            <div class="alert bg-red-300 mb-8 p-4 border-2 border-solid border-red-500 rounded-lg" role="alert">
                                El producto ha sido eliminado!
                            </div>
                        @endif

                        <div class="px-4 py-4 flex justify-center mb-7">
                            <a href="{{route('products.create')}}" class="button cursor-pointer bg-indigo-600 text-white rounded-lg px-4 py-3 text-center font-weight-500 hover:bg-indigo-800" id="btnNuevoProducto">+ Nuevo producto</a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                              <thead class="bg-gray-200">
                                <tr>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">ID producto</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Imagen</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Nombre</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Descripción</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Cantidad</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Precio unitario ($)</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Estado</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Fecha Agregado</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Fecha modificado</th>
                                  <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Acción</th>
                                </tr>
                              </thead>
                                   <tbody class="border border-gray-400">
                                       @foreach( $products as $product )
                                       <tr class="">
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->id}}</td>
                                           <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">
                                            @if($product->imagen)
                                                <img src="{{ asset('storage/' . $product->imagen) }}" alt="Imagen de {{ $product->nombre }}" class="w-16 h-16 object-cover">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->nombre}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center break-words">{{$product->descripcion}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->cantidad}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->precio}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->estado}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->created_at}}</td>
                                           <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$product->updated_at}}</td>
                                           <td class="flex py-2 justify-between py-2 px-4 border-b text-sm text-gray-700 text-center">
                                               <a href="{{ route('products.edit', ['product' => $product->id]) }}"><img src="{{ asset('images/edit-icon.ico') }}" alt="Editar" style="width:28px"></a>
                                               <button type="button" onclick="openModal('{{ $product->id }}')"><img src="{{asset('images/bassurero.ico')}}" alt="Eliminar" style="width: 20px;"></button>
                                           </td>
                                       </tr>

                                       <!-- Modal -->
                                       <div id="deleteModal{{ $product->id }}" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                            <span class="close text-gray-500 hover:text-gray-700 text-xl cursor-pointer float-right" onclick="closeModal('{{ $product->id }}')">&times;</span>
                                            <p class="text-lg font-semibold mb-4">¿Estás seguro de que deseas eliminar este producto?</p>
                                            <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex justify-end space-x-3">
                                                    <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600">
                                                        Eliminar
                                                    </button>
                                                    <button type="button" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-300" onclick="closeModal('{{ $product->id }}')">
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
    </div>
    <script>
        function openModal(productId) {
            document.getElementById("deleteModal" + productId).style.display = "block";
        }

        function closeModal(productId) {
            document.getElementById("deleteModal" + productId).style.display = "none";
        }
    </script>
</x-app-layout>
