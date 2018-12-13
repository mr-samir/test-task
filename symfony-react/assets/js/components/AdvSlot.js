import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';
import AdvBanner from './AdvBanner';

const styles = {
    mainGrid: {
        border: '1px solid black',
        textAlign: 'center',
        padding: '20px',
    },
};

class AdvSlot extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        const { classes } = this.props;
        return (
            <Grid item className={classes.mainGrid}>
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

AdvSlot.propTypes = {
    show_banner: PropTypes.bool.isRequired,
    slot_name: PropTypes.string.isRequired,
    slot_sizes: PropTypes.string.isRequired,
    slot_element_id: PropTypes.string.isRequired,
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(AdvSlot);
