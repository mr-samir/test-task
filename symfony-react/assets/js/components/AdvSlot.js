import React from 'react';
import ReactDOM from 'react-dom';

import Grid from '@material-ui/core/Grid';
import AdvBanner from './AdvBanner';

class AdvSlot extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Grid item style={{ border: '1px solid black', textAlign: 'center', padding: '20px' }}>
                {this.props.show_banner
                && this.props.slot_name
                && this.props.slot_sizes
                && this.props.slot_element_id ? (
                    <AdvBanner
                        slot_name={this.props.slot_name}
                        slot_sizes={this.props.slot_sizes}
                        slot_element_id={this.props.slot_element_id}
                    />
                ) : (
                    ""
                )}
            </Grid>
        );
    }
}

export default AdvSlot;
