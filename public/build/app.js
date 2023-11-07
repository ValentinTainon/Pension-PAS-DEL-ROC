"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)


/* Livre d'or */
var commentaires = document.querySelectorAll(".commentaire-content");
var commentaireIndex = 0;

// Afficher le premier commentaire
if (commentaires[commentaireIndex]) {
  var manageCommentaires = function manageCommentaires() {
    // Masquer le commentaire actuel
    commentaires[commentaireIndex].style.visibility = "collapse";
    commentaires[commentaireIndex].style.opacity = 0;

    // Passer au commentaire suivant
    commentaireIndex = (commentaireIndex + 1) % commentaires.length;

    // Afficher le commentaire suivant
    commentaires[commentaireIndex].style.visibility = "visible";
    commentaires[commentaireIndex].style.opacity = 1;
  };
  commentaires[commentaireIndex].style.visibility = "visible";
  commentaires[commentaireIndex].style.opacity = 1;
  setInterval(manageCommentaires, 5000);
}

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_web_timers_js"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQzBCOztBQUUxQjtBQUNBLElBQUlBLFlBQVksR0FBR0MsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxzQkFBc0IsQ0FBQztBQUNwRSxJQUFJQyxnQkFBZ0IsR0FBRyxDQUFDOztBQUV4QjtBQUNBLElBQUlILFlBQVksQ0FBQ0csZ0JBQWdCLENBQUMsRUFBRTtFQUFBLElBSXZCQyxrQkFBa0IsR0FBM0IsU0FBU0Esa0JBQWtCLEdBQUc7SUFDMUI7SUFDQUosWUFBWSxDQUFDRyxnQkFBZ0IsQ0FBQyxDQUFDRSxLQUFLLENBQUNDLFVBQVUsR0FBRyxVQUFVO0lBQzVETixZQUFZLENBQUNHLGdCQUFnQixDQUFDLENBQUNFLEtBQUssQ0FBQ0UsT0FBTyxHQUFHLENBQUM7O0lBRWhEO0lBQ0FKLGdCQUFnQixHQUFHLENBQUNBLGdCQUFnQixHQUFHLENBQUMsSUFBSUgsWUFBWSxDQUFDUSxNQUFNOztJQUUvRDtJQUNBUixZQUFZLENBQUNHLGdCQUFnQixDQUFDLENBQUNFLEtBQUssQ0FBQ0MsVUFBVSxHQUFHLFNBQVM7SUFDM0ROLFlBQVksQ0FBQ0csZ0JBQWdCLENBQUMsQ0FBQ0UsS0FBSyxDQUFDRSxPQUFPLEdBQUcsQ0FBQztFQUNwRCxDQUFDO0VBZERQLFlBQVksQ0FBQ0csZ0JBQWdCLENBQUMsQ0FBQ0UsS0FBSyxDQUFDQyxVQUFVLEdBQUcsU0FBUztFQUMzRE4sWUFBWSxDQUFDRyxnQkFBZ0IsQ0FBQyxDQUFDRSxLQUFLLENBQUNFLE9BQU8sR0FBRyxDQUFDO0VBY2hERSxXQUFXLENBQUNMLGtCQUFrQixFQUFFLElBQUksQ0FBQztBQUN6Qzs7Ozs7Ozs7Ozs7QUNoQ0EiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcz8zZmJhIl0sInNvdXJjZXNDb250ZW50IjpbIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuXG4vKiBMaXZyZSBkJ29yICovXG5sZXQgY29tbWVudGFpcmVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIi5jb21tZW50YWlyZS1jb250ZW50XCIpO1xubGV0IGNvbW1lbnRhaXJlSW5kZXggPSAwO1xuXG4vLyBBZmZpY2hlciBsZSBwcmVtaWVyIGNvbW1lbnRhaXJlXG5pZiAoY29tbWVudGFpcmVzW2NvbW1lbnRhaXJlSW5kZXhdKSB7XG4gICAgY29tbWVudGFpcmVzW2NvbW1lbnRhaXJlSW5kZXhdLnN0eWxlLnZpc2liaWxpdHkgPSBcInZpc2libGVcIjtcbiAgICBjb21tZW50YWlyZXNbY29tbWVudGFpcmVJbmRleF0uc3R5bGUub3BhY2l0eSA9IDE7XG5cbiAgICBmdW5jdGlvbiBtYW5hZ2VDb21tZW50YWlyZXMoKSB7XG4gICAgICAgIC8vIE1hc3F1ZXIgbGUgY29tbWVudGFpcmUgYWN0dWVsXG4gICAgICAgIGNvbW1lbnRhaXJlc1tjb21tZW50YWlyZUluZGV4XS5zdHlsZS52aXNpYmlsaXR5ID0gXCJjb2xsYXBzZVwiO1xuICAgICAgICBjb21tZW50YWlyZXNbY29tbWVudGFpcmVJbmRleF0uc3R5bGUub3BhY2l0eSA9IDA7XG5cbiAgICAgICAgLy8gUGFzc2VyIGF1IGNvbW1lbnRhaXJlIHN1aXZhbnRcbiAgICAgICAgY29tbWVudGFpcmVJbmRleCA9IChjb21tZW50YWlyZUluZGV4ICsgMSkgJSBjb21tZW50YWlyZXMubGVuZ3RoO1xuXG4gICAgICAgIC8vIEFmZmljaGVyIGxlIGNvbW1lbnRhaXJlIHN1aXZhbnRcbiAgICAgICAgY29tbWVudGFpcmVzW2NvbW1lbnRhaXJlSW5kZXhdLnN0eWxlLnZpc2liaWxpdHkgPSBcInZpc2libGVcIjtcbiAgICAgICAgY29tbWVudGFpcmVzW2NvbW1lbnRhaXJlSW5kZXhdLnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIH1cbiAgICBzZXRJbnRlcnZhbChtYW5hZ2VDb21tZW50YWlyZXMsIDUwMDApO1xufSIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJjb21tZW50YWlyZXMiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJjb21tZW50YWlyZUluZGV4IiwibWFuYWdlQ29tbWVudGFpcmVzIiwic3R5bGUiLCJ2aXNpYmlsaXR5Iiwib3BhY2l0eSIsImxlbmd0aCIsInNldEludGVydmFsIl0sInNvdXJjZVJvb3QiOiIifQ==