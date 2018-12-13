import React from 'react';
import ReactDOM from 'react-dom';

import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import FormControl from '@material-ui/core/FormControl';
import FormGroup from '@material-ui/core/FormGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import ButtonBase from '@material-ui/core/ButtonBase';

class AdvForm extends React.Component {
    constructor(props) {
        super(props);

        this.handleInputChange = this.handleInputChange.bind(this);
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.props.updateData(name, value);
    }

    render() {
        return (
            <Grid item style={{ border: '1px solid black', marginBottom: '20px', padding: '20px' }}>
                <Typography variant="h5" gutterBottom style={{ fontWeight: '600' }}>
                    ADV
                </Typography>
                <FormControl component="fieldset">
                    <FormGroup>
                        <FormControlLabel
                            style={{ marginLeft: 0 }}
                            control={
                                <Checkbox
                                    name="is_available"
                                    checked={this.props.is_available}
                                    onChange={this.handleInputChange}
                                    color="primary"
                                />
                            }
                            label={
                                <div style={{ fontSize: '18px' }}>
                                    on/off
                                </div>
                            }
                            labelPlacement="start"
                        />
                        <FormControlLabel
                            style={{ marginLeft: 0 }}
                            control={
                                <Checkbox
                                    name="is_lazy"
                                    checked={this.props.is_lazy}
                                    onChange={this.handleInputChange}
                                    color="primary"
                                />
                            }
                            label={
                                <div style={{ fontSize: '18px' }}>
                                    lazy &nbsp; &nbsp;
                                </div>
                            }
                            labelPlacement="start"
                        />
                    </FormGroup>
                </FormControl>
                {this.props.is_lazy ? (
                    <div>
                        <ButtonBase
                            style={{
                                border: '1px solid black',
                                width: '98%',
                                padding: '10px 0',
                                marginLeft: '3px',
                                marginTop: '8px'
                            }}
                            children="Show ADV"
                            onClick={event => this.props.showBanner()}
                        />
                    </div>
                ) : ("")}

            </Grid>
        );
    }
}

export default AdvForm;
