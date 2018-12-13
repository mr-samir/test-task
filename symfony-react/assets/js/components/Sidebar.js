import React from 'react';
import ReactDOM from 'react-dom';

import Websocket from 'react-websocket';
import {wsUrl, slotElementId} from '../etc/config.json';
import api from '../api/apiHandler';

import Grid from '@material-ui/core/Grid';
import AdvForm from './AdvForm';
import AdvSlot from './AdvSlot';

class Sidebar extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            slot_element_id: slotElementId,
            slot_name: '',
            slot_sizes: '',
            is_available: false,
            is_lazy:  false,
            show_banner: false,
        };
    }

    componentWillMount() {
        api.getSlot(this.state.slot_element_id)
            .then(res => {
                this.setStateFromData(res.data);
            })
            .catch(err => {
                console.error(err)
            })
        ;
    }

    updateData(name, value) {
        api.updateSlot(slotElementId, {[name]: value})
            .then(res => {
                this.setStateFromData(res.data);
            })
            .catch(err => {
                console.error(err)
            })
        ;
    }

    handleData(data) {
        let result = JSON.parse(data);
        this.setStateFromData(result);
    }

    setStateFromData(data) {
        if (data['is_available']) {
            this.showBanner();
        } else if (false === data['is_available'] && false === data['is_lazy']) {
            this.showBanner(false);
        }

        this.setState({
            slot_name: data['slot_name'],
            slot_sizes: data['slot_sizes'],
            is_available: data['is_available'],
            is_lazy: data['is_lazy'],
        });
    }

    showBanner(value = true) {
        this.setState({
            show_banner: value,
        });
    }

    render() {
        return (
            <Grid
                style={{ width: '300px' }}
                container
                direction="column"
                justify="space-between"
                alignItems="stretch"
            >
                <Websocket
                    url={wsUrl + `/${slotElementId}`}
                    onMessage={this.handleData.bind(this)}
                />
                <AdvForm
                    updateData={this.updateData.bind(this)}
                    is_available={this.state.is_available}
                    is_lazy={this.state.is_lazy}
                    showBanner={this.showBanner.bind(this)}
                />
                <AdvSlot
                    show_banner={this.state.show_banner}
                    slot_name={this.state.slot_name}
                    slot_sizes={this.state.slot_sizes}
                    slot_element_id={this.state.slot_element_id}
                />
            </Grid>
        );
    }
}

export default Sidebar;
