(function(){
    var factory = function (exports) {
        var lang = {
            name : "en",
            description : "El editor de Markdown de código abierto.",
            tocTitle    : "Tabla de contenido",
            toolbar : {
                undo             : "Deshacer(Ctrl+Z)",
                redo             : "Rehacer(Ctrl+Y)",
                bold             : "Negrita",
                del              : "Tachado",
                italic           : "Cursiva",
                quote            : "Cita",
                ucwords          : "La primera letra de las palabras en mayúsculas",
                uppercase        : "Mayúsculas",
                lowercase        : "Minúscula",
                h1               : "Encabezado 1",
                h2               : "Encabezado 2",
                h3               : "Encabezado 3",
                h4               : "Encabezado 4",
                h5               : "Encabezado 5",
                h6               : "Encabezado 6",
                "list-ul"        : "Lista desordenada",
                "list-ol"        : "Lista ordenada",
                hr               : "Separador",
                link             : "Enlace",
                "reference-link" : "Enlace de referencia",
                image            : "Imagen",
                code             : "Línea de código",
                "preformatted-text" : "Texto preformateado / Bloque de código (tabulación)",
                "code-block"     : "Bloque de código (Multi-lenguajes)",
                table            : "Tabla",
                datetime         : "Fecha y hora",
                emoji            : "Emoticono",
                "html-entities"  : "Entidades HTML",
                pagebreak        : "Salto de página",
                watch            : "Unwatch",
                unwatch          : "Mirar",
                preview          : "Vista previa del HTML (Shift + ESC)",
                fullscreen       : "Pantalla completa (ESC)",
                clear            : "Limpiar",
                search           : "Buscar",
                help             : "Ayuda",
                info             : "Acerca de " + exports.title
            },
            buttons : {
                enter  : "Aceptar",
                cancel : "Cancelar",
                close  : "Cerrar"
            },
            dialog : {
                link : {
                    title    : "Enlace",
                    url      : "Dirección",
                    urlTitle : "Título",
                    urlEmpty : "Error: Por favor, complete la dirección del enlace."
                },
                referenceLink : {
                    title    : "Enlace con referencia",
                    name     : "Nombre",
                    url      : "Dirección",
                    urlId    : "ID",
                    urlTitle : "Título",
                    nameEmpty: "Error: La referencia no puede estar vacía.",
                    idEmpty  : "Error: Por favor, rellene el identificador del enlace con referencia.",
                    urlEmpty : "Error: Por favor, rellene la URL del enlace."
                },
                image : {
                    title    : "Imagen",
                    url      : "Dirección",
                    link     : "Enlace",
                    alt      : "Título",
                    uploadButton     : "Subir",
                    imageURLEmpty    : "Error: picture url address can't be empty.",
                    uploadFileEmpty  : "Error: upload pictures cannot be empty!",
                    formatNotAllowed : "Error: only allows to upload pictures file, upload allowed image file format:"
                },
                preformattedText : {
                    title             : "Preformatted text / Codes", 
                    emptyAlert        : "Error: Please fill in the Preformatted text or content of the codes."
                },
                codeBlock : {
                    title             : "Code block",         
                    selectLabel       : "Languages: ",
                    selectDefaultText : "select a code language...",
                    otherLanguage     : "Other languages",
                    unselectedLanguageAlert : "Error: Please select the code language.",
                    codeEmptyAlert    : "Error: Please fill in the code content."
                },
                htmlEntities : {
                    title : "HTML Entities"
                },
                help : {
                    title : "Help"
                }
            }
        };
        
        exports.defaults.lang = lang;
    };
    
	// CommonJS/Node.js
	if (typeof require === "function" && typeof exports === "object" && typeof module === "object")
    { 
        module.exports = factory;
    }
	else if (typeof define === "function")  // AMD/CMD/Sea.js
    {
		if (define.amd) { // for Require.js

			define(["editormd"], function(editormd) {
                factory(editormd);
            });

		} else { // for Sea.js
			define(function(require) {
                var editormd = require("../editormd");
                factory(editormd);
            });
		}
	} 
	else
	{
        factory(window.editormd);
	}
    
})();