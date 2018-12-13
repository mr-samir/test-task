import React from 'react';
import ReactDOM from 'react-dom';
import Grid from '@material-ui/core/Grid';

class Content extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Grid
                style={{ width: 'calc(100% - 320px)', border: '1px solid black' }}
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

export default Content;
