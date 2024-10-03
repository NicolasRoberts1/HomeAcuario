<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
</head>
<body style="padding: 0; margin:0;">
    <div style="padding-top: 3rem; padding-bottom: 3rem;">
        <div style="margin-left: auto; margin-right: auto; padding-left: 1.5rem; padding-right: 1.5rem;">
            @auth
            <h2 style="margin-bottom: 1rem; padding-left: 0.5rem; padding-right: 0.5rem; color: black; font-weight: bold; font-size: 1.25rem;">
                Pedido
            </h2>
            <div style="overflow-x: auto;">
                <table style="min-width: 100%; background-color: white; border: 1px solid #d1d5db;">
                  <thead style="background-color: #e5e7eb;">
                    <tr>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">ID Pedido</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Fecha</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Cliente</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Dirección</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Pago</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Tipo</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Observación</th>
                    </tr>
                  </thead>
                       <tbody style="border: 1px solid #9ca3af;">
                           <tr>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->id}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->fecha}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->cliente}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center; word-wrap: break-word;">{{$order->direccion}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->pago}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->tipo}}</td>
                               <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$order->observacion}}</td>
                           </tr>
                       </tbody>
                </table>
            </div>
            <h2 style="margin-bottom: 1rem; margin-top: 2rem; padding-left: 0.5rem; padding-right: 0.5rem; color: black; font-weight: bold; font-size: 1.25rem;">
                Productos asociados al pedido
            </h2>

            <div style="overflow-x: auto;">
                <table style="min-width: 100%; background-color: white; border: 1px solid #d1d5db; table-layout: auto;">
                  <thead style="background-color: #e5e7eb;">
                    <tr>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">ID Producto</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Nombre</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Precio ($)</th>
                      <th style="padding: 0.5rem 1rem; border-bottom: 1px solid; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody style="border: 1px solid #9ca3af;">
                      @foreach($products as $product)
                      <tr>
                          <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$product->id}}</td>
                          <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$product->nombre}}</td>
                          <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">
                            @if($order->tipo == 'minorista')
                                {{$product->precio_minorista}}
                            @endif
                            @if($order->tipo == 'mayorista')
                                {{$product->precio_mayorista}}
                            @endif
                        </td>
                          <td style="padding: 0.5rem 1rem; border-bottom: 1px solid; font-size: 0.875rem; color: #374151; text-align: center;">{{$product->pivot->cantidad}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>

            <div style="display: flex; margin-bottom: 1rem; margin-top: 2rem; padding-left: 0.5rem; padding-right: 0.5rem; justify-content: center; gap: 4rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <h3 style="color: black; font-weight: bold; font-size: 1.25rem;">
                        Pre Entrega:
                    </h3>
                    <p>{{$order->pre_entrega}}</p>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <h3 style="color: black; font-weight: bold; font-size: 1.25rem;">
                        Total:
                    </h3>
                    <p>{{$order->total}}</p>
                </div>
            </div>
@endauth
        </div>
    </div>
</body>
</html>
