// acf.add_action('ready', function( $el ){
// 	let $elements = jQuery('#acf-field_5a9ec677b751f');
//   $elements.alphanum({
//     allow: "#.,_-:>[=]\r\n",
//     allowOtherCharSets: false,
//     allowNewline: true,
//     allowSpace: true
//   });
// });
//
// acf.add_filter('validation_complete', function( json, $form ){
//   let fields = $form.serializeArray();
// 	if( !json.errors ) {
//     json.errors = [];
//     let valid = false;
//     let url = '';
//     let sel = '';
//     fields.forEach(field => {
//       if (field.name == 'acf[field_5a9ec677b751f]') {
//         sel = field.value.trim();
//       } else if (field.name == 'acf[field_5a9ec651b751e]') {
//         url = field.value.trim();
//       }
//     });
//     // check if url exists
//     jQuery.ajax({
//         url: apiSettings.root + 'validateurl/v1?url=' + url,
//         async: false,
//         type: 'GET',
//         beforeSend: function ( xhr ) {
//           xhr.setRequestHeader( 'X-WP-Nonce', apiSettings.nonce );
//           xhr.overrideMimeType('text/plain; charset=x-user-defined');
//         },
//         success: function(res) {
//           res = JSON.parse(res);
//           valid = res.valid;
//         }
//     });
//     if (!valid) {
//       let error = {
//         input: "acf[field_5a9ec651b751e]",
//         message: "This URL does not exists or the page is currently down."
//       };
//       json.valid = 0;
//       json.errors.push(error);
//     }
//     sel = sel.replace(/\n/g, ",");
//     try {
//       let dummy = document.createElement('br');
//       dummy.querySelector(sel);
//     } catch (e) {
//       let error = {
//         input: "acf[field_5a9ec677b751f]",
//         message: e.toString()
//       };
//       json.valid = 0;
//       json.errors.push(error);
//     }
// 	}
// 	return json;
// });
