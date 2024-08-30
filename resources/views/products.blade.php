<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!--class="row"-->
            <!--col-8 offset-2-->
                <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col">
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

                        <a href="{{route('products.create')}}" class="" id="btnNuevoProducto">+ Nuevo producto</a>


                        <table class="">
                            <thead class="">
                                <tr>
                                    <th>ID producto</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Estado</th>
                                    <th>Fecha Agregado</th>
                                    <th>Fecha modificado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $products as $product )
                                <tr class="">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->imagen}}</td>
                                    <td>{{$product->nombre}}</td>
                                    <td>{{$product->descripcion}}</td>
                                    <td>{{$product->cantidad}}</td>
                                    <td>{{$product->precio}}</td>
                                    <td>{{$product->estado}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>{{$product->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}">EDITAR</a>
                                        <button type="button" onclick="openModal('{{ $product->id }}')">Eliminar</button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div id="deleteModal{{ $product->id }}" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('{{ $product->id }}')">&times;</span>
                                        <p>¿Estás seguro de que deseas eliminar este producto?</p>
                                        <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                            <button type="button" onclick="closeModal('{{ $product->id }}')">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
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
