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


                    @auth
                        <a href="{{route('products.create')}}" class="" id="btnNuevoProducto">+ Nuevo producto</a>

                        <div class="contProducts">
                            @foreach( $products as $product )
                                <div class="nombre">
                                    <p>{{$products->nombre}}</p>
                                </div>
                            @endforeach
                        </div>

                    @endauth
                </div>
        </div>
    </div>
</x-app-layout>
