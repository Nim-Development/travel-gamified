const STEP_1 = "STEP_1";
const STEP_2 = "STEP_2";
const STEP_3 = "STEP_3";

const CREATE = "CREATE";
const SELECT = "SELECT";

import React, { Component } from "react";

import Select from "react-select";
import {
    Row,
    Col,
    Card,
    CardBody,
    Button,
    UncontrolledButtonDropdown,
    CardHeader,
    DropdownToggle,
    DropdownMenu,
    DropdownItem
} from "reactstrap";

import CitySelector from "./Selectors/CitySelector";
import RouteSelector from "./Selectors/RouteSelector";
import TransitSelector from "./Selectors/TransitSelector";
import CityCreator from "./Creators/CityCreator";

export default class InsertPlayfield extends Component {
    constructor(props) {
        super(props);
        this.state = {
            playfield: {
                label: null,
                value: null
            },

            step: {
                action: STEP_1,
                type: null,
                createOrSelect: null
            },
            cities: this.props.cities,
            routes: this.props.routes,
            transits: this.props.transits
        };
        // this.submitPlayfield = this.submitPlayfield.bind(this);
    }

    handleSelectChange = selectedOption => {
        this.setState({ ...this.state, playfield: selectedOption });
    };

    omitPlayfield = () => {
        // omit the new playfield up to the parent Tour comment to be added to the array at index
        this.props.omitPlayfield(
            this.state.playfield.value,
            this.state.step.type,
            this.props.index
        );
    };

    omitDelete = () => {
        // omit the deletion of this playfield picker
        this.props.omitDelete(this.props.index, null);
    };

    wizzard(step) {
        switch (step.action) {
            case STEP_1:
                return this.renderPlayfieldTypePicker();
                break;

            case STEP_2:
                return this.renderSelectOrNew();
                break;

            case STEP_3:
                switch (step.createOrSelect) {
                    case CREATE:
                        // make a new playfield
                        switch (step.type) {
                            case "city":
                                return this.renderCityCreator();
                                break;
                            case "route":
                                return this.renderRouteCreator();
                                break;
                            case "transit":
                                return this.renderTransitCreator();
                                break;

                            default:
                                break;
                        }
                        break;
                    case SELECT:
                        // select an existing playfield
                        switch (step.type) {
                            case "city":
                                return this.renderCitySelector();
                                break;
                            case "route":
                                return this.renderRouteSelector();
                                break;
                            case "transit":
                                return this.renderTransitSelector();
                                break;

                            default:
                                break;
                        }
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
    }

    renderPlayfieldTypePicker() {
        return (
            <div className="grid-menu grid-menu-3col">
                <Row className="no-gutters">
                    <Col xl="4" sm="6">
                        <Button
                            className="btn-icon-vertical btn-square btn-transition"
                            outline
                            color="warning"
                            onClick={() =>
                                this.setState({
                                    step: {
                                        action: STEP_2,
                                        type: "transit"
                                    }
                                })
                            }
                        >
                            <i className="lnr-rocket btn-icon-wrapper"> </i>
                            <span className="badge badge-warning badge-dot badge-dot-lg badge-dot-inside">
                                {" "}
                            </span>
                            Transit
                        </Button>
                    </Col>
                    <Col xl="4" sm="6">
                        <Button
                            className="btn-icon-vertical btn-square btn-transition"
                            outline
                            color="success"
                            onClick={() =>
                                this.setState({
                                    step: {
                                        action: STEP_2,
                                        type: "city"
                                    }
                                })
                            }
                        >
                            <i className="lnr-apartment btn-icon-wrapper"> </i>
                            <span className="badge badge-success badge-dot badge-dot-inside">
                                {" "}
                            </span>
                            City
                        </Button>
                    </Col>
                    <Col xl="4" sm="6">
                        <Button
                            className="btn-icon-vertical btn-square btn-transition"
                            outline
                            color="warning"
                            onClick={() =>
                                this.setState({
                                    step: {
                                        action: STEP_2,
                                        type: "route"
                                    }
                                })
                            }
                        >
                            <i className="lnr-map-marker btn-icon-wrapper"> </i>
                            <span className="badge badge-warning badge-dot badge-dot-inside">
                                {" "}
                            </span>
                            Route
                        </Button>
                    </Col>
                </Row>
            </div>
        );
    }

    renderSelectOrNew() {
        return (
            <div className="grid-menu grid-menu-3col">
                <Row className="no-gutters">
                    <Col xl="6" sm="6">
                        <Button
                            className="btn-icon-vertical btn-square btn-transition"
                            outline
                            color="success"
                            onClick={() =>
                                this.setState({
                                    step: {
                                        ...this.state.step,
                                        action: STEP_3,
                                        createOrSelect: CREATE
                                    }
                                })
                            }
                        >
                            <i className="lnr-plus-circle btn-icon-wrapper">
                                {" "}
                            </i>
                            NEW
                        </Button>
                    </Col>
                    <Col xl="6" sm="6">
                        <Button
                            className="btn-icon-vertical btn-square btn-transition"
                            outline
                            color="success"
                            onClick={() =>
                                this.setState({
                                    step: {
                                        ...this.state.step,
                                        action: STEP_3,
                                        createOrSelect: SELECT
                                    }
                                })
                            }
                        >
                            <i className="lnr-select btn-icon-wrapper"> </i>
                            SELECT
                        </Button>
                    </Col>
                </Row>
            </div>
        );
    }

    handleNewPlayfield = playfield => {
        this.props.omitNewPlayfield(
            playfield,
            this.state.step.type,
            this.props.index
        );
    };

    renderCityCreator() {
        return (
            <CityCreator
                omitNewPlayfield={playfield =>
                    this.handleNewPlayfield(playfield)
                } //
                className={"modal-lg"}
            />
        );
    }

    renderRouteCreator() {
        console.log("CREATE ROUTE");
    }
    renderTransitCreator() {
        console.log("CREATE TRANSIT");
    }

    renderCitySelector() {
        return (
            <CitySelector
                playfield={this.state.playfield}
                cities={this.state.cities}
                omitSelectChange={() => this.handleSelectChange}
                omitPlayfield={() => this.omitPlayfield}
            />
        );
    }
    renderRouteSelector() {
        return (
            <RouteSelector
                playfield={this.state.playfield}
                routes={this.state.routes}
                omitSelectChange={() => this.handleSelectChange}
                omitPlayfield={() => this.omitPlayfield}
            />
        );
    }
    renderTransitSelector() {
        return (
            <TransitSelector
                playfield={this.state.playfield}
                transits={this.state.transits}
                omitSelectChange={() => this.handleSelectChange}
                omitPlayfield={() => this.omitPlayfield}
            />
        );
    }

    render() {
        return (
            <div>
                <Card className="main-card mb-3">
                    <CardHeader>
                        Playfield Picker
                        <div className="btn-actions-pane-right actions-icon-btn">
                            <UncontrolledButtonDropdown>
                                <DropdownToggle
                                    className="mb-2 mr-2 btn-icon btn-icon-only"
                                    color="link"
                                >
                                    <i className="pe-7s-trash btn-icon-wrapper">
                                        {" "}
                                    </i>
                                </DropdownToggle>
                                <DropdownMenu className="dropdown-menu-rounded">
                                    <DropdownItem onClick={this.omitDelete}>
                                        Are u sure?
                                    </DropdownItem>
                                </DropdownMenu>
                            </UncontrolledButtonDropdown>
                        </div>
                    </CardHeader>
                    <CardBody>{this.wizzard(this.state.step)}</CardBody>
                </Card>
            </div>
        );
    }
}
