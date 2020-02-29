import React, { Component, Fragment } from "react";
import ReactDOM from "react-dom";
import ReactCSSTransitionGroup from "react-addons-css-transition-group";
import Select from "react-select";

import {
    Map,
    InfoWindow,
    Marker,
    GoogleApiWrapper,
    Polyline
} from "google-maps-react";

import {
    Button,
    Form,
    FormGroup,
    Label,
    Input,
    FormText,
    Row,
    Col,
    Card,
    CardBody,
    CardTitle,
    Container
} from "reactstrap";

import Slider, { createSliderWithTooltip } from "rc-slider";
const SliderWithTooltip = createSliderWithTooltip(Slider);

export class Route extends Component {
    constructor(props) {
        super(props);

        // format current transit to be {label: ..., value: ...}, so that it fits in the selector

        console.log(props);

        this.state = {
            ...props.route.data.value,
            transits: this.props.transits.data
        };
    }

    componentDidMount() {
        console.log(this.state);
    }

    handleDurationSliderDays = days => {
        this.setState({
            ...this.state,
            duration: { ...this.state.duration, days: days }
        });
    };
    handleDurationSliderHours = hours => {
        this.setState({
            ...this.state,
            duration: { ...this.state.duration, hours: hours }
        });
    };
    handleDurationSliderMinutes = minutes => {
        this.setState({
            ...this.state,
            duration: { ...this.state.duration, minutes: minutes }
        });
    };

    handleKilometerSlider = kilometers => {
        this.setState({ ...this.state, kilometers: kilometers });
    };

    handleHighwaySlider = highway => {
        this.setState({ ...this.state, highway: highway });
    };

    handleDifficultySlider = difficulty => {
        this.setState({ ...this.state, difficulty: difficulty });
    };

    handleNatureSlider = nature => {
        this.setState({ ...this.state, nature: nature });
    };

    handleTransitSelectChange = transit => {
        this.setState({ ...this.state, transit: transit });
    };

    render() {
        return (
            <Fragment>
                <ReactCSSTransitionGroup
                    component="div"
                    transitionName="TabsAnimation"
                    transitionAppear={true}
                    transitionAppearTimeout={0}
                    transitionEnter={false}
                    transitionLeave={false}
                >
                    <Container fluid>
                        <Row>
                            <Col md="12">
                                <Card className="main-card mb-3">
                                    <CardBody>
                                        <CardTitle>Controls Types</CardTitle>
                                        <Form>
                                            <FormGroup>
                                                <Label for="name">Name</Label>
                                                <Input
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    placeholder="Name"
                                                />
                                            </FormGroup>
                                            <FormGroup>
                                                <Label for="maps_url">
                                                    Maps Url
                                                </Label>
                                                <Input
                                                    type="text"
                                                    name="maps_url"
                                                    id="maps_url"
                                                    placeholder="Google maps route url"
                                                />
                                            </FormGroup>
                                            <Row form>
                                                <Col md={6}>
                                                    <FormGroup>
                                                        <Label for="kilometers">
                                                            Kilometers
                                                        </Label>
                                                        <Input
                                                            type="number"
                                                            name="kilometers"
                                                            id="kilometers"
                                                            placeholder="kms"
                                                        />
                                                    </FormGroup>
                                                </Col>
                                                <Col md={6}>
                                                    <FormGroup>
                                                        <Label for="exampleState">
                                                            Duration
                                                        </Label>
                                                        <SliderWithTooltip
                                                            tipFormatter={v =>
                                                                `${v} Days`
                                                            }
                                                            tipProps={{
                                                                prefixCls:
                                                                    "rc-slider-tooltip",
                                                                placement: "top"
                                                            }}
                                                            className="mb-2"
                                                            min={0}
                                                            max={20}
                                                            value={
                                                                this.state
                                                                    .duration
                                                                    .days
                                                            }
                                                            onChange={
                                                                this
                                                                    .handleDurationSliderDays
                                                            }
                                                        />
                                                        <SliderWithTooltip
                                                            tipFormatter={v =>
                                                                `${v} Hours`
                                                            }
                                                            tipProps={{
                                                                prefixCls:
                                                                    "rc-slider-tooltip",
                                                                placement: "top"
                                                            }}
                                                            className="mb-2"
                                                            min={0}
                                                            max={24}
                                                            value={
                                                                this.state
                                                                    .duration
                                                                    .hours
                                                            }
                                                            onChange={
                                                                this
                                                                    .handleDurationSliderHours
                                                            }
                                                        />
                                                        <SliderWithTooltip
                                                            tipFormatter={v =>
                                                                `${v} Minutes`
                                                            }
                                                            tipProps={{
                                                                prefixCls:
                                                                    "rc-slider-tooltip",
                                                                placement: "top"
                                                            }}
                                                            className="mb-2"
                                                            min={0}
                                                            step={5}
                                                            max={60}
                                                            value={
                                                                this.state
                                                                    .duration
                                                                    .minutes
                                                            }
                                                            onChange={
                                                                this
                                                                    .handleDurationSliderMinutes
                                                            }
                                                        />
                                                        <div
                                                            style={{
                                                                fontSize: "16px"
                                                            }}
                                                        >
                                                            <strong>
                                                                {
                                                                    this.state
                                                                        .duration
                                                                        .days
                                                                }
                                                            </strong>{" "}
                                                            days,{" "}
                                                            <strong>
                                                                {
                                                                    this.state
                                                                        .duration
                                                                        .hours
                                                                }
                                                            </strong>{" "}
                                                            hours,{" "}
                                                            <strong>
                                                                {
                                                                    this.state
                                                                        .duration
                                                                        .minutes
                                                                }
                                                            </strong>{" "}
                                                            minutes.
                                                        </div>
                                                        {/* <Input
                                                            type="text"
                                                            name="state"
                                                            id="exampleState"
                                                        /> */}
                                                    </FormGroup>
                                                </Col>
                                            </Row>
                                            <FormGroup>
                                                <Label for="">
                                                    Difficulty:{" "}
                                                    <strong>
                                                        {" "}
                                                        {this.state.difficulty}%
                                                    </strong>
                                                </Label>
                                                <SliderWithTooltip
                                                    tipFormatter={v => `${v} %`}
                                                    tipProps={{
                                                        prefixCls:
                                                            "rc-slider-tooltip",
                                                        placement: "top"
                                                    }}
                                                    className="mb-2"
                                                    step={1}
                                                    min={0}
                                                    max={100}
                                                    value={
                                                        this.state.difficulty
                                                    }
                                                    onChange={
                                                        this
                                                            .handleDifficultySlider
                                                    }
                                                />
                                                <Label for="">
                                                    Highway:{" "}
                                                    <strong>
                                                        {" "}
                                                        {this.state.highway}%
                                                    </strong>
                                                </Label>
                                                <SliderWithTooltip
                                                    tipFormatter={v => `${v} %`}
                                                    tipProps={{
                                                        prefixCls:
                                                            "rc-slider-tooltip",
                                                        placement: "top"
                                                    }}
                                                    className="mb-2"
                                                    step={1}
                                                    min={0}
                                                    max={100}
                                                    value={this.state.highway}
                                                    onChange={
                                                        this.handleHighwaySlider
                                                    }
                                                />
                                                <Label for="">
                                                    Nature:{" "}
                                                    <strong>
                                                        {this.state.nature}%
                                                    </strong>
                                                </Label>
                                                <SliderWithTooltip
                                                    tipFormatter={v => `${v} %`}
                                                    tipProps={{
                                                        prefixCls:
                                                            "rc-slider-tooltip",
                                                        placement: "top"
                                                    }}
                                                    className="mb-2"
                                                    step={1}
                                                    min={0}
                                                    max={100}
                                                    value={this.state.nature}
                                                    onChange={
                                                        this.handleNatureSlider
                                                    }
                                                />
                                            </FormGroup>
                                            <FormGroup>
                                                <Label for="">Transit</Label>
                                                <Select
                                                    value={this.state.transit}
                                                    onChange={e =>
                                                        this.handleTransitSelectChange(
                                                            e
                                                        )
                                                    }
                                                    options={
                                                        this.state.transits
                                                    }
                                                />
                                            </FormGroup>

                                            <Button
                                                color="primary"
                                                className="mt-1"
                                            >
                                                Submit
                                            </Button>
                                        </Form>
                                    </CardBody>
                                </Card>
                                <Card>
                                    <CardBody>
                                        <Form>
                                            <Row form>
                                                <Col md={6}>
                                                    <FormGroup>
                                                        <Label for="kilometers">
                                                            Start
                                                        </Label>
                                                        <Row form>
                                                            <Col md={6}>
                                                                <Input
                                                                    type="number"
                                                                    name="kilometers"
                                                                    id="kilometers"
                                                                    placeholder="kms"
                                                                />
                                                            </Col>
                                                            <Col md={6}>
                                                                <Input
                                                                    type="number"
                                                                    name="kilometers"
                                                                    id="kilometers"
                                                                    placeholder="kms"
                                                                />
                                                            </Col>
                                                        </Row>
                                                    </FormGroup>
                                                </Col>
                                                <Col md={6}>
                                                    <FormGroup>
                                                        <Label for="kilometers">
                                                            Finish
                                                        </Label>
                                                        <Row form>
                                                            <Col md={6}>
                                                                <Input
                                                                    type="number"
                                                                    name="kilometers"
                                                                    id="kilometers"
                                                                    placeholder="kms"
                                                                />
                                                            </Col>
                                                            <Col md={6}>
                                                                <Input
                                                                    type="number"
                                                                    name="kilometers"
                                                                    id="kilometers"
                                                                    placeholder="kms"
                                                                />
                                                            </Col>
                                                        </Row>
                                                    </FormGroup>
                                                </Col>
                                            </Row>
                                        </Form>
                                    </CardBody>
                                </Card>
                                <Card
                                    style={{
                                        // width: "100%",
                                        height: "100%",
                                        position: "relative",
                                        paddingBottom: "30px"
                                    }}
                                >
                                    <Map
                                        style={{
                                            width: "100%",
                                            height: "100%",
                                            position: "relative"
                                        }}
                                        google={this.props.google}
                                        zoom={6}
                                        initialCenter={{
                                            lat: 15.7475364,
                                            lng: 101.4043701
                                        }}
                                    >
                                        {/* <Marker onClick={this.onMarkerClick} name={"Current location"} /> */}

                                        {/* <Polyline
                                                    path={this.state.polyPath}
                                                    strokeColor="#0000FF"
                                                    strokeOpacity={0.8}
                                                    strokeWeight={5}
                                                /> */}
                                        <InfoWindow
                                            onClose={this.onInfoWindowClose}
                                        >
                                            <div>
                                                <h1>{"henkiehenkie"}</h1>
                                            </div>
                                        </InfoWindow>
                                    </Map>
                                </Card>
                            </Col>
                        </Row>
                    </Container>
                </ReactCSSTransitionGroup>
            </Fragment>
        );
    }
}

const Render = GoogleApiWrapper({
    apiKey: "AIzaSyB3j2mEdy2UTnuWrzFq3u8T9X21KoMWkSA"
})(Route);

if (document.getElementById("route")) {
    const element = document.getElementById("route");
    const route = JSON.parse(element.getAttribute("route")); // Data passed in from blade view
    const transits = JSON.parse(element.getAttribute("transits"));
    ReactDOM.render(<Render route={route} transits={transits} />, element);
}
