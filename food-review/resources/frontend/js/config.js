const toolbarOptions = {
    container: [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{
            'header': 1
        }, {
            'header': 2
        }],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }],
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }],
        [{
            'direction': 'rtl'
        }],
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        [{
            'color': []
        }, {
            'background': []
        }],
        [{
            'font': []
        }],
        [{
            'align': []
        }],
        ['clean'],
        ['emoji'],
        ['link', 'image', 'video']
    ],
    handlers: {
        'emoji': function () {}
    }

}
const options = {
    debug: 'info',
    modules: {
        toolbar: toolbarOptions,
        "emoji-toolbar": true,
    },
    scrollingContainer: '#scrolling-container', 
    placeholder: 'Viết nội dung đánh giá vào đây ...',
    theme: 'snow',

};

export default options;