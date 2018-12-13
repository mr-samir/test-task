import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';

const styles = {
    content: {
        width: 'calc(100% - 320px)',
        border: '1px solid black',
    },
};

class Content extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        const { classes } = this.props;
        return (
            <Grid
                className={classes.content}
                container
                direction="column"
                justify="center"
                alignItems="center"
            >
                <Grid item>
                    TEXT
                </Grid>
            </Grid>
        );
    }
}

Content.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(Content);
