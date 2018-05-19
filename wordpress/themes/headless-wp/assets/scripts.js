// (function(window, $) {
//   const buildFigure = (image, width, height, $canvas) => {
//     const tree = new QuadTree2Factory(image, width, height, {
//       maxDepth: 9,
//       threshold: 4,
//       squared: true,
//       centered: true
//     });
//     tree.getLeafs().forEach(tile => {
//       const {x, y, width, height} = tile;
//       const div = $('<div></div>').css({
//         left: x,
//         top: y,
//         width,
//         height
//       });
//       $canvas.append(div);
//     });
//   };
//
//   const buildWebsite = (url, elements, $website) => {
//     const $screenshot = $($website).find(".screenshot");
//     const $elements = $($website).find(".elements");
//     $.ajax({
//       url: apiSettings.root + 'inspect/v1?url=' + url + '&elements=' + elements,
//       type: "GET",
//       beforeSend: function ( xhr ) {
//         xhr.setRequestHeader( 'X-WP-Nonce', apiSettings.nonce );
//       },
//       success: function (result, textStatus, jqXHR) {
//         if (result) {
//           const elements = result.elements;
//           const screenshot = result.screenshot;
//           const image = new Image();
//           image.src = "data:image/png;base64," + screenshot;
//           $screenshot.append(image);
//
//           if (Array.isArray(elements)) {
//             elements.forEach(tile => {
//               const size = (tile.width >= 250 && tile.height >= 80)
//                 ? "&nbsp;<span class='size'><small>" + tile.width + "x" + tile.height + "</small><span>"
//                 : "";
//               $("<div><span class='tag'>" + tile.tag + "</span>" + size + "</div>").css({
//                 top: tile.top,
//                 left: tile.left,
//                 width: tile.width,
//                 height: tile.height
//               }).appendTo($elements);
//             });
//           }
//           $('#website .elements div')
//             .textfill()
//             .hover(
//               function() {
//                 $(this).find('span').css('visibility',  'visible');
//               },
//               function() {
//                 $(this).find('span').css('visibility',  'hidden');
//               }
//             );
//           $(".wrap").addClass('loaded');
//         }
//       },
//       error: function(xhr, textStatus, errorThrown){
//         $(".wrap").addClass("error");
//         $("#error-msg .msg").html(errorThrown.toString());
//       }
//     });
//   };
//
//   $(() => {
//     const width = 1920;
//     const height = 1080 / 3;
//     const $canvas = $("#canvas");
//     const $website = $("#website");
//
//     buildFigure(data.image, width, height, $canvas);
//     buildWebsite(data.url, data.elements, $website);
//   });
// })(window, jQuery);
