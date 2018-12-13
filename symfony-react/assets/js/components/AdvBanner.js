import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import postscribe from 'postscribe';

class AdvBanner extends Component {
    componentWillMount() {
        if (!document.getElementById('googletagservices')) {
            const div = document.createElement('div');
            div.id = "googletagservices";
            document.body.appendChild(div);

            postscribe(
                '#googletagservices',
                '<script src="https://www.googletagservices.com/tag/js/gpt.js" async="async"></script>' +
                '<script>var googletag = googletag || {}; googletag.cmd = googletag.cmd || [];</script>'
            );

            const defineSlot = `'${this.props.slot_name}', ${this.props.slot_sizes}, '${this.props.slot_element_id}'`;
            postscribe(
                '#googletagservices',
                '<script>' +
                    'googletag.cmd.push(function() {' +
                        'googletag.defineSlot(' + defineSlot + ')' +
                        '.addService(googletag.pubads());' +
                        'googletag.pubads().enableSingleRequest();' +
                        'googletag.enableServices();' +
                    '});' +
                '</script>'
            );
        }
    }

    // If necessary, remove the scripts
    // componentWillUnmount() {
    //     const div = document.getElementById('googletagservices');
    //     if (div) {
    //         div.remove();
    //     }
    // }

    componentDidMount() {
        postscribe(
            '#' + this.props.slot_element_id,
            '<script>' +
            'googletag.cmd.push(function(){ googletag.display("' + this.props.slot_element_id + '"); });' +
            '</script>'
        );
    }

    render() {
        return React.createElement('div', {id: this.props.slot_element_id});
    }
}

export default AdvBanner;
