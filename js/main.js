 angular

 		.module('indexApp',['ngRoute', 'ngStorage'])
	    
 		

	    .controller('mainCtrlApp',function($scope, $http){

	    	
        
        //Función para subir las imagenes
        $scope.subir = function() {
            
            $scope.miImagen = $scope.imagen[0].name;
            $scope.miMarcagua =$scope.marcagua[0].name;
            
            var peticion = {
                "url" : "./php/upload.php",
                "method" : "POST" 
            }
            $http(peticion).then(function(fueBien){                
               
                $scope.rutas = angular.copy(fueBien);
                alert('Tus archivos se han subido');
            },
            function(fueMal){
                
               alert('Tenemos un problema con las rutas a las imagenes');
                
            });
        }


	})

	    
	    .config(function($routeProvider,$locationProvider){
	$locationProvider.hashPrefix('');
	$routeProvider
		
		.when('/', {
			templateUrl : 'vistas/home.view.html',
			controller : 'mainCtrlApp'
		})
		.when('/home', {
			templateUrl : 'vistas/home.view.html',
			controller : 'mainCtrlApp'
		})
        .when('/servicio', {
			templateUrl : 'vistas/servicio.view.html',
			controller : 'mainCtrlApp'
		})
        
        .otherwise({
			reditecTo: '/'
		})
	})

		.directive('cabecera', function(){
			var template = {
				templateUrl:'vistas/header.view.html'
			}
			return template;
		})

	    .directive('pie', function(){
	    	var template = {
	    		templateUrl:'vistas/footer.view.html'
	    	}
	    	return template;
	    })

        .directive("selectNgFiles", function() {
            return {
                    require: "ngModel",
                    link: function postLink(scope,elem,attrs,ngModel) {
                    elem.on("change", function(e) {
                    var files = elem[0].files;
                    ngModel.$setViewValue(files);
                    })
                }
            }
        })
