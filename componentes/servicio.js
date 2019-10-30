angular
    .module('servicioApp', ['mgStorage'])
    .controller('servicioCtrl', function($scope, $http){
        var miImagen= $scope.$parent.miImagen;
        //Función para mezclar las imagenes
        $scope.mezclar = function(){
            var mezcla = 'mezcla.jpg';
            var imagen = $scope.miImagen;
            var marcagua = $scope.miMarcagua;
        
        alert('Vas a enviar las fotos al servidor');
        
        var  peticion = {
           "url" : "php/mezclador.php",
           "method" : "POST",
           "data" : "imagen"+imagen+"&marcagua"+marcagua+"&mezcla"+mezcla,
           "headers" : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF8'}
        }
        $http(peticion).then(function(fueBien){
            $scope.respuesta = angular.copy(fueBien.data);
            alert('Tu imagen ha sigo mezclada correctamente');
        },
        function(fueMal){
            alert('Tenemos un problema con la petición');
        });
    }
    });
