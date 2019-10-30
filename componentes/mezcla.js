.module('mezclaApp',[ngStorage])
.controller('mezclaCtrl', function($scope,$html)){
    
    $scope.mezclar = function (){
        var mezcla = 'mezcla.ipg';
        var imagen = $scope.miImagen;
        var marcagua = $scope.miMarcagua;
       var  peticion = {
           "url" : "php/mezclador.php",
           "method" : "POST",
           "data" : "imagen"+imagen+"&marcagua"+marcagua+"&mezcla"+mezcla,
           "headers" : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF8'}
        }
        $http(peticion).then(function(fueBien){
            $scope.respuesta = angular.copy(fueBien.data);
        },
        function(fueMal){
            alert('Tenemos un problema con la petición');
        }
        );
       alert('Esta es tu imagen mezclada');
        
    }
}
