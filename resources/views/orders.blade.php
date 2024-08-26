<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!--class="row"-->
            <!--col-8 offset-2-->
                <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col">

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


                    @auth
                        <a href="{{route('orders.create')}}" class="" id="btnAdd">+ Añadir</a>

                        <div class="contOrders">
                            @foreach( $orders as $order )
                                <div class="clientes">
                                    <p>{{$orders->cliente}}</p>
                                </div>
                            @endforeach
                        </div>

                    @endauth
                </div>
        </div>
    </div>
</x-app-layout>

