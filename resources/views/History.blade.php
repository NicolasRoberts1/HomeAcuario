<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <label for="buscarFecha" class="px-1 font-medium text-lg text-gray-600">Filtrar por fecha</label>
                <input type="date" name="buscarFecha" id="buscarFecha"  class="border border-gray-300 px-3 py-2 rounded-md w-36 mt-2 mb-5">
            </div>


            <table id="historyTable" class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">ID Pedido</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Fecha</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Cliente</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Dirección</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Total ($)</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Productos</th>
                <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Estado</th>
                </tr>
            </thead>
                <tbody class="border border-gray-400">
                    @foreach( $histories as $history )
                    <tr class="history-row">
                        <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$history->id_orden}}</td>
                        <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center fecha">{{$history->fecha}}</td>
                        <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$history->cliente}}</td>
                        <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center break-words">{{$history->direccion}}</td>
                        <td  class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{$history->total}}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-700 text-center"><a href="{{route('orders.extendOrder', ['order'=>$history->id_orden])}}" class="flex justify-center"><img src="{{asset('images/blue-plus.ico')}}" alt="Ver productos" style="width: 20px;"></a></td>
                        <td  class="py-2 px-4 border-b text-sm text-green-400 text-center">{{$history->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <script>
            document.getElementById('buscarFecha').addEventListener('input', function() {
                // Obtener la fecha seleccionada por el usuario (solo el formato 'YYYY-MM-DD')
                const selectedDate = this.value;

                // Obtener todas las filas de la tabla con la clase 'history-row'
                const rows = document.querySelectorAll('.history-row');

                rows.forEach(row => {
                    // Obtener la fecha de la fila actual (la columna de la fecha tiene la clase 'fecha')
                    const rowDate = row.querySelector('.fecha').textContent.trim().substring(0, 10); // Tomar solo 'YYYY-MM-DD'

                    // Verificar si la fecha de la fila coincide con la fecha seleccionada
                    if (rowDate === selectedDate) {
                        // Mostrar la fila si coincide
                        row.style.display = '';
                    } else {
                        // Ocultar la fila si no coincide
                        row.style.display = 'none';
                    }
                });
            });

        </script>
</x-app-layout>
