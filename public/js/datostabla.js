/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/datostabla.js":
/*!************************************!*\
  !*** ./resources/js/datostabla.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // Manejar el evento de entrada en los inputs de artículo
  $(document).on('input', '.articuloInput', function () {
    var articulo = $(this).val();
    var filaActual = $(this).closest('tr');
    var proximaFila = filaActual.next();

    // Realizar una solicitud AJAX al servidor para obtener los datos del artículo
    $.ajax({
      url: '/obtener-datosde-tabla',
      // Reemplaza esto con la URL de tu controlador
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        articulo: articulo
      },
      success: function success(response) {
        if (response && response.codigo) {
          // Rellenar los campos de la fila actual con los datos del artículo
          filaActual.find('#numserie').text(response.id);
          filaActual.find('#codart').text(response.codigo);
          filaActual.find('#punit').text(response.precio_compra_sin_iva);
          filaActual.find('#total').text(response.id_iva);
          filaActual.find('#stock').text(response.stock_actual);
        } else {
          // Limpia los campos de la fila actual si no se encontraron datos
          filaActual.find('#numserie').text('');
          filaActual.find('#codart').text('');
          filaActual.find('#punit').text('');
          filaActual.find('#total').text('');
          filaActual.find('#stock').text('');
        }

        // Verificar si ya existe una fila vacía al final de la tabla
        var filas = $('#miTabla tbody tr');
        var ultimaFila = filas[filas.length - 1];
        var inputUltimaFila = $(ultimaFila).find('.articuloInput');

        // Crear una nueva fila solo si la última fila no está vacía
        if (articulo.trim() !== '' && inputUltimaFila.val() !== '') {
          var newRow = filaActual.clone(true); // Clonar la fila actual y sus eventos
          newRow.find('.articuloInput').val(''); // Limpiar el input del nuevo artículo
          $('#miTabla tbody').append(newRow); // Agregar la nueva fila a la tabla
        }
      },

      error: function error() {
        // Manejo de errores si es necesario
      }
    });
  });
});

/***/ }),

/***/ 4:
/*!******************************************!*\
  !*** multi ./resources/js/datostabla.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\ortiz\Desktop\Laravel\softres-main\resources\js\datostabla.js */"./resources/js/datostabla.js");


/***/ })

/******/ });