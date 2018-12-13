import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom';

import Grid from '@material-ui/core/Grid';
import Content from './components/Content';
import Sidebar from './components/Sidebar';

class App extends React.Component {
  render() {
    return (
        <Grid
            style={{ width: '1000px', margin: 'auto' }}
            container
            direction="row"
            justify="space-between"
            alignItems="stretch"
        >
            <Content />
            <Sidebar />
        </Grid>
    );
  }
}

if (document.getElementById('root')) {
    ReactDOM.render(
        <App />,
        document.getElementById('root')
    );
}
