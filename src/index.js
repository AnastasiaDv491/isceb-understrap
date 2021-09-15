const { registerBlockType} = wp.blocks;
const {InspectorControls,ColorPalette, MediaUpload} = wp.editor;
const { PanelBody, IconButton} = wp.components;
registerBlockType('isceb-theme/isceb-author-img', {

    title: 'Author Image',
    description: 'Block to add author img to a page',
    icon: 'format-image',
    category: 'Media',

    attributes: {
        author:{
            type: 'string'
        },
        authorImage:{
            type: 'string',
            default: null
        },
        titleColor:{
            type: 'string',
            default: 'red'
        }
    },

    edit({ attributes, setAttributes }) {
        const {
            author,
            titleColor,
            authorImage
        } = attributes;


        function onSelectAuthorImage(image){
            //improve with right resolution 
            console.log(image);
            setAttributes({authorImage: image.sizes.thumbnail.url});
        }

        function onTitleColourChange(color){
            setAttributes({titleColor:color});
        }

        function updateAuthor(event) {

            setAttributes( { author: event.target.value } );
        }
        // Everytime you change code here & it is final, you have to run "npm run build:scripts"
        // Run "npm run start-build to watch your changes in index.js file"
        return ([
        <InspectorControls style= {{marginBottom:'40px'}}>

            <PanelBody title = {'Font color settings'}>
                <p> Selet a title color </p>
                <ColorPalette value={titleColor}
                                onChange={onTitleColourChange}/>
            </PanelBody>
            <PanelBody title={'Author Image'}>
                <p>Select a  Bacgkround Image </p>
                <MediaUpload 
                    onSelect={onSelectAuthorImage}
                    type="image"
                    value={authorImage}
                    render={ ( { open } ) => (
							<IconButton
								className="editor-media-placeholder__button is-button is-default is-large"
								icon="upload"
								onClick={ open }>
								 Background Image
							</IconButton>
						)}
                />
            </PanelBody>
        </InspectorControls>
        ,
        <div>
        <input type="text" onChange={ updateAuthor} value={ attributes.author } style={ { color: titleColor} } />
        <img src={authorImage} 
        style={{
            borderRadius: '50%',
            height: '60px',
            width: '60px',
            border: '5px solid #1F476B'
            // boxShadow: '0px 4px 4px rgba(0, 0, 0, 0.25)'
        }} 
        class="isceb-standard-page-author-img"/>

        

        </div>]);


    },

    save( { attributes }) {

        const {
            authorImage,
            author
        } = attributes;

        return ( 
        
        <div>
        <h6>{ author }</h6>
        <img src={authorImage} style={{
            borderRadius: '50%',
            height: '60px',
            width: '60px',
            border: '5px solid #1F476B'
            // boxShadow: '0px 4px 4px rgba(0, 0, 0, 0.25)'
        }}
         class="isceb-standard-page-author-img"
       /> 
       </div>
        );
    }
});