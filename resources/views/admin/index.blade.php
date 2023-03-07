<x-app-layout>
    <div class="row ">
        <div class="col-2">
        </div>
        <div class="col-8 my-5">
            <h1 style="display: flex;justify-content: center;font-family:fantasy;">Bienvenidos al sistema de Cotizaciones
                UNAMBA</h1>
        </div>
        <div class="col-2">
            <img class="img-fluid" style="width: 100px;" src="{{ asset('img/logounamba.png') }}" alt="">
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$cot}}</h3>
                    <h1>Cotizaciones</h1>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <div class="small-box-footer">&nbsp;</div>
            </div>
        </div>

        <div class="col-md col-6">

            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3>{{$req}}</h3>
                    <h1>Requerimientos</h1>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('requerimientos.index') }}" class="small-box-footer" >Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</x-app-layout>
