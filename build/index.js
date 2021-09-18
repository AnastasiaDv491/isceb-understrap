/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

// Everytime you change code here & it is final, you have to run "npm run build:scripts"
// Run "npm run start-build to watch your changes in index.js file"
var registerBlockType = wp.blocks.registerBlockType;
var _wp$editor = wp.editor,
    InspectorControls = _wp$editor.InspectorControls,
    ColorPalette = _wp$editor.ColorPalette,
    MediaUpload = _wp$editor.MediaUpload;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    IconButton = _wp$components.IconButton;
registerBlockType('isceb-theme/isceb-author-img', {
  title: 'Author Image',
  description: 'Block to add author img to a page',
  icon: 'format-image',
  category: 'Media',
  attributes: {
    author: {
      type: 'string'
    },
    authorImage: {
      type: 'string',
      "default": null
    },
    titleColor: {
      type: 'string',
      "default": 'red'
    },
    topic: {
      type: 'string',
      "default": null
    },
    date: {
      type: 'integer',
      "default": null
    }
  },
  edit: function edit(_ref) {
    var attributes = _ref.attributes,
        setAttributes = _ref.setAttributes;
    var author = attributes.author,
        titleColor = attributes.titleColor,
        authorImage = attributes.authorImage,
        topic = attributes.topic,
        date = attributes.date;

    function onSelectAuthorImage(image) {
      //improve with right resolution 
      console.log(image);
      setAttributes({
        authorImage: image.sizes.thumbnail.url
      });
    }

    function onTitleColourChange(color) {
      setAttributes({
        titleColor: color
      });
    }

    function updateAuthor(event) {
      setAttributes({
        author: event.target.value
      });
    }

    function updateTopic(topic) {
      setAttributes({
        topic: topic.target.value
      });
    }

    function updateDate(date) {
      setAttributes({
        date: date.target.value
      });
    }

    return [(0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(InspectorControls, {
      style: {
        marginBottom: '40px'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelBody, {
      title: 'Font color settings'
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, " Selet a title color "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ColorPalette, {
      value: titleColor,
      onChange: onTitleColourChange
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelBody, {
      title: 'Author Image'
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, "Select a  Bacgkround Image "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(MediaUpload, {
      onSelect: onSelectAuthorImage,
      type: "image",
      value: authorImage,
      render: function render(_ref2) {
        var open = _ref2.open;
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(IconButton, {
          className: "editor-media-placeholder__button is-button is-default is-large",
          icon: "upload",
          onClick: open
        }, "Background Image");
      }
    }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      "class": "isceb-standard-page-title-head"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
      type: "text",
      onChange: updateTopic,
      value: attributes.topic,
      placeholder: "Post topic",
      "class": "isceb-standard-page-topic"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
      type: "text",
      onChange: updateDate,
      value: attributes.date,
      placeholder: "Post date",
      "class": "isceb-standard-page-date"
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      "class": "isceb-standard-page-head-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
      type: "text",
      onChange: updateAuthor,
      value: attributes.author,
      style: {
        color: titleColor
      },
      placeholder: "Name of the page's author",
      "class": "isceb-standard-page-author"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: authorImage,
      style: {
        borderRadius: '50%',
        height: '60px',
        width: '60px',
        border: '5px solid #1F476B' // boxShadow: '0px 4px 4px rgba(0, 0, 0, 0.25)'

      },
      "class": "isceb-standard-page-author-img"
    })))];
  },
  save: function save(_ref3) {
    var attributes = _ref3.attributes;
    var authorImage = attributes.authorImage,
        author = attributes.author,
        topic = attributes.topic,
        date = attributes.date;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      "class": "isceb-standard-page-title-head"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h6", {
      "class": "isceb-standard-page-topic"
    }, "Topic: ", topic), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h6", {
      "class": "isceb-standard-page-date"
    }, date)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      "class": "isceb-standard-page-head-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: authorImage,
      style: {
        borderRadius: '50%',
        height: '60px',
        width: '60px',
        border: '5px solid #1F476B' // boxShadow: '0px 4px 4px rgba(0, 0, 0, 0.25)'

      },
      "class": "isceb-standard-page-author-img"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h6", {
      "class": "isceb-standard-page-author"
    }, author, " ")));
  }
});
}();
/******/ })()
;
//# sourceMappingURL=index.js.map