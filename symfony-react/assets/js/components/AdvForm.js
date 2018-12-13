import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import FormControl from '@material-ui/core/FormControl';
import FormGroup from '@material-ui/core/FormGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import ButtonBase from '@material-ui/core/ButtonBase';

const styles = {
    mainGrid: {
        border: '1px solid black',
        marginBottom: '20px',
        padding: '20px',
    },
    title: {
        fontWeight: '600',
    },
    formControlLabel: {
        marginLeft: 0,
    },
    label: {
        fontSize: '18px',
    },
    buttonShow: {
        border: '1px solid black',
        width: '98%',
        padding: '10px 0',
        marginLeft: '3px',
        marginTop: '8px',
    },
};

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
        const { classes } = this.props;
        return (
            <Grid item className={classes.mainGrid}>
                <Typography variant="h5" gutterBottom className={classes.title}>
                    ADV
                </Typography>
                <FormControl component="fieldset">
                    <FormGroup>
                        <FormControlLabel
                            className={classes.formControlLabel}
                            control={
                                <Checkbox
                                    name="is_available"
                                    checked={this.props.is_available}
                                    onChange={this.handleInputChange}
                                    color="primary"
                                />
                            }
                            label={
                                <div className={classes.label}>
                                    on/off
                                </div>
                            }
                            labelPlacement="start"
                        />
                        <FormControlLabel
                            className={classes.formControlLabel}
                            control={
                                <Checkbox
                                    name="is_lazy"
                                    checked={this.props.is_lazy}
                                    onChange={this.handleInputChange}
                                    color="primary"
                                />
                            }
                            label={
                                <div className={classes.label}>
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
                            className={classes.buttonShow}
                            children="Show ADV"
                            onClick={event => this.props.showBanner()}
                        />
                    </div>
                ) : ("")}

            </Grid>
        );
    }
}

AdvForm.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(AdvForm);
