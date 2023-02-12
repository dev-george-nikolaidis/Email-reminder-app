/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./app/resources/app.js":
/*!******************************!*\
  !*** ./app/resources/app.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sass_main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sass/main.scss */ \"./app/resources/sass/main.scss\");\n\r\n\r\n// Delete and Update logic\r\nif (document.querySelector(\".data-row\")) {\r\n    //Dom manipulation helper functions\r\n    const addTextError = (targetElement, text) => {\r\n        const domElem = document.querySelector(targetElement);\r\n        domElem.textContent = text;\r\n    };\r\n\r\n    // Validation  helper functions\r\n    const validateDate = (day) => {\r\n        const numbers = /^[-+]?[0-9]+$/;\r\n        if (day.length === 0) {\r\n            return \"Das Datum darf nicht leer sein.\";\r\n        }\r\n\r\n        if (!day.match(numbers)) {\r\n            return \"Das Datum muss eine Zahl sein.\";\r\n        }\r\n\r\n        if (Number(day) <= 0 || Number(day) > 31) {\r\n            return \"Das Datum muss zwischen 1 und 31 liegen.\";\r\n        }\r\n    };\r\n\r\n    const validateMonth = (month) => {\r\n        const numbers = /^[-+]?[0-9]+$/;\r\n        if (month.length === 0) {\r\n            return \"Die Monatseingabe darf nicht leer sein.\";\r\n        }\r\n\r\n        if (!month.match(numbers)) {\r\n            return \"Das Monatseingabe muss eine Zahl sein.\";\r\n        }\r\n\r\n        if (Number(month) <= 0 || Number(month) > 12) {\r\n            return \"Die Monatseingabe muss zwischen 1 und 12 liegen.\";\r\n        }\r\n    };\r\n\r\n    // Generic fetch function\r\n    const fetchHandler = async (actionUrl, options) => {\r\n        let data = null;\r\n        let error = null;\r\n        const fullUrl = `${window.location.href}${actionUrl}`;\r\n\r\n        try {\r\n            const res = await fetch(fullUrl, options);\r\n            if (res.status >= 200 && res.status < 300) {\r\n                const responseData = await res.json();\r\n                data = responseData;\r\n            }\r\n        } catch (err) {\r\n            console.log(err);\r\n            error = err;\r\n        }\r\n\r\n        return { data, error };\r\n    };\r\n\r\n    const handleClick = (e) => {\r\n        // Find out the table row\r\n        const trElem = e.currentTarget.closest(\"tr\");\r\n        // Find out the id of the row\r\n        const id = trElem.dataset.rowId;\r\n        // Find out what action we have  Update or Delete\r\n        const action = e.currentTarget.textContent;\r\n        const descriptionElem = trElem.querySelector(\".description\");\r\n\r\n        // We update\r\n        if (action === \"bearbeiten\") {\r\n            const response = confirm(\r\n                `Sind Sie sicher, dass Sie diese ${descriptionElem.value} aktualisieren möchten ?`\r\n            );\r\n            if (response) {\r\n                {\r\n                    // Select the elements for update\r\n                    const dayElem = trElem.querySelector(\".day\");\r\n                    const monthElem = trElem.querySelector(\".month\");\r\n\r\n                    // Validate day input\r\n                    const dayErrorMessage = validateDate(dayElem.value.trim());\r\n\r\n                    if (dayErrorMessage != undefined) {\r\n                        const dayErrorElem = document.querySelector(\".day-error\");\r\n                        addTextError(\".day-error\", dayErrorMessage);\r\n                        dayElem.classList.add(\"input-error\");\r\n                    } else {\r\n                        addTextError(\".day-error\", \"\");\r\n                        dayElem.classList.remove(\"input-error\");\r\n                    }\r\n\r\n                    //validate month input\r\n                    const monthErrorMessage = validateMonth(monthElem.value.trim());\r\n                    if (monthErrorMessage != undefined) {\r\n                        const monthErrorElem = document.querySelector(\".month-error\");\r\n                        addTextError(\".month-error\", monthErrorMessage);\r\n                        monthElem.classList.add(\"input-error\");\r\n                    } else {\r\n                        addTextError(\".month-error\", \"\");\r\n                        monthElem.classList.remove(\"input-error\");\r\n                    }\r\n\r\n                    // Validate   description\r\n                    if (descriptionElem.value.trim().length === 0) {\r\n                        const descriptionErrorElem =\r\n                            document.querySelector(\".description-error\");\r\n                        addTextError(\r\n                            \".description-error\",\r\n                            \"Die Bezeichnung darf nicht leer sein.\"\r\n                        );\r\n                        descriptionElem.classList.add(\"input-error\");\r\n                    } else {\r\n                        addTextError(\".description-error\", \"\");\r\n                        descriptionElem.classList.remove(\"input-error\");\r\n                    }\r\n\r\n                    const updateSelectElem = trElem.querySelector(\".select-update\");\r\n                    const selectValue =\r\n                        updateSelectElem.options[updateSelectElem.selectedIndex].value;\r\n\r\n                    // Check if we do not have errors to post ajax requests to the server for update\r\n                    if (\r\n                        dayErrorMessage === undefined &&\r\n                        monthErrorMessage === undefined &&\r\n                        descriptionElem.value.trim().length > 1\r\n                    ) {\r\n                        const options = {\r\n                            method: \"POST\",\r\n                            mode: \"same-origin\",\r\n                            credentials: \"same-origin\",\r\n                            headers: {\r\n                                \"Content-Type\": \"application/json\",\r\n                            },\r\n                            body: JSON.stringify({\r\n                                item_id: id,\r\n                                day: dayElem.value,\r\n                                month: monthElem.value,\r\n                                description: descriptionElem.value,\r\n                                time_reminder: selectValue,\r\n                            }),\r\n                        };\r\n                        // fetchHandler(\"appointments/update\", options);\r\n                        if (fetchHandler(\"appointments/update\", options)) {\r\n                            if (dayElem.value.length <= 1) {\r\n                                dayElem.value = \"0\" + dayElem.value + \".\";\r\n                            } else {\r\n                                dayElem.value = dayElem.value + \".\";\r\n                            }\r\n\r\n                            if (monthElem.value.length <= 1) {\r\n                                monthElem.value = \"0\" + monthElem.value + \".\";\r\n                            } else {\r\n                                monthElem.value = monthElem.value + \".\";\r\n                            }\r\n\r\n                            alert(\"Erfolg aktualisieren\");\r\n                        }\r\n                    }\r\n                }\r\n            }\r\n        }\r\n        // We delete\r\n        if (action === \"löschen\") {\r\n            const response = confirm(\r\n                `Sind Sie sicher, dass Sie diese ${descriptionElem.value} löschen möchten `\r\n            );\r\n\r\n            if (response) {\r\n                const options = {\r\n                    method: \"POST\",\r\n                    mode: \"same-origin\",\r\n                    credentials: \"same-origin\",\r\n                    headers: {\r\n                        \"Content-Type\": \"application/json\",\r\n                    },\r\n                    body: JSON.stringify({ item_id: id }),\r\n                };\r\n                const { data, error } = fetchHandler(\"appointments/delete\", options);\r\n\r\n                // remove element from dom\r\n                trElem.remove();\r\n            }\r\n        }\r\n    };\r\n\r\n    const editElements = document.querySelectorAll(\".edit\");\r\n    editElements.forEach((el) => {\r\n        el.addEventListener(\"click\", handleClick);\r\n    });\r\n\r\n    const removeElements = document.querySelectorAll(\".delete\");\r\n    removeElements.forEach((el) => {\r\n        el.addEventListener(\"click\", handleClick);\r\n    });\r\n\r\n    \r\n}\r\n\r\n\r\n// Logout logic\r\nif (document.querySelector(\".logout-link\")) {\r\n    const navbarLogoutElement = document.querySelector(\".logout-link\");\r\n\r\n    navbarLogoutElement.addEventListener(\"click\", (e) => {\r\n        const response = confirm(\"Sie möchten sich abmelden?\");\r\n\r\n        if (!response) {\r\n            e.preventDefault();\r\n        }\r\n    });\r\n}\r\n\n\n//# sourceURL=webpack://calendar/./app/resources/app.js?");

/***/ }),

/***/ "./app/resources/sass/main.scss":
/*!**************************************!*\
  !*** ./app/resources/sass/main.scss ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://calendar/./app/resources/sass/main.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./app/resources/app.js");
/******/ 	
/******/ })()
;