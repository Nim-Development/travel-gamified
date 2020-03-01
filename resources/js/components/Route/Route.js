import React, { Component, Fragment } from "react";
import ReactDOM from "react-dom";
import ReactCSSTransitionGroup from "react-addons-css-transition-group";
import Select from "react-select";

import setAuthorizationToken from "../utils/setAuthorizationToken";

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
    Container,
    CardFooter
} from "reactstrap";

const TOKEN =
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMmQ4YjVjYjk3ZmQyOGQ5NjBiODQ1NjJlNDM4MjAxODQ1OWU2ZTNhNjI1MWUwYTkzZjJkYTliNzkyZDFjMWM4ZmU1MGQ5MjE2OTBkNjM0ZTkiLCJpYXQiOjE1ODMwMDM5OTAsIm5iZiI6MTU4MzAwMzk5MCwiZXhwIjoxNjE0NjI2MzkwLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EAkHTme4k0geE97-CXVF1OFGg6wls8onc-3tLZdXNsKg8br_d6RR9Q5pFUdc8Po-_Kps2-7bOmsqyM6wYmRTugaLJfmqKDgfX_ZC_-menA28IWCmWmiPUICIFb3X8T4HRvOeKdk09Rab_1qiBpSgxedsx6-eOji-zLXmQ07kCo8X4x87Ci8FjChxwWtFTEHEHT1uVmUudPKqE14yXzQvykJESS_lQWxROu8IoTh2nXDunXBzo2f3vGZ9brO1RHhsaMuLJP0PEd8vJXP2ZYasWXSLByQXlVKKeYpklj3q9LKypImu6dPOcXCHyN_tU2BOOT3Ci9_jwE04A8yOtn4OkfDOhKbDZTC8qOMguIzLkIMOtgFkiuTXDhEWoFklxqtg3pojTo0cF6Vp5drJduEvoTY5O0ePyL3LOWW3a139ZmQiCmVhIVQ_bBEAWEH1_xI6HKdAzO3ATxm1la0KxTKkd805pYs00hBK8lLZUnCfnNEk79hIywhy4_tGqrUwn1n8_HGPt2XGYhWmGZsMxVQu4Cp96GC19HFva_3-_6uzbTJxaqCo2llyWv8bqzCMFi6a-zVx3Y2Kqfy0DGrtN5U_PHRE61CK-vyNY51DeEmtbrfqonExSFb-XtQtlQAo5Ca_X6eQCWsLTx3VlIkbl16hdEWDzjyk7cpC1pvM_scsank";

import PolyLineGeoDataMaker from "./PolyLineGeoDataMaker";

import Slider, { createSliderWithTooltip } from "rc-slider";
const SliderWithTooltip = createSliderWithTooltip(Slider);

export class Route extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ...props.route.data.value,
            transits: this.props.transits.data
        };
    }

    componentDidMount() {
        // ...
    }

    persistTourInfo = () => {
        const body = {
            transit_id: this.state.transit.value.id,
            name: this.state.name,
            maps_url: this.state.maps_url,
            kilometers: this.state.kilometers,
            duration: this.timeToSeconds(),
            difficulty: this.state.difficulty,
            nature: this.state.nature,
            highway: this.state.highway
        };

        console.log(body);

        setAuthorizationToken(TOKEN);

        axios
            .put(
                `http://127.0.0.1:8000/api/admin/routes/${this.state.id}`,
                body
            )
            .then(res => {
                console.log(res);
            })
            .catch(err => {
                console.log(err);
            });
    };

    persistPolyline = () => {
        const body = {
            polyline: this.state.polyline
        };

        setAuthorizationToken(TOKEN);

        axios
            .put(
                `http://127.0.0.1:8000/api/admin/routes/${this.state.id}`,
                body
            )
            .then(res => {
                console.log(res);
            })
            .catch(err => {
                console.log(err);
            });
    };

    timeToSeconds = () => {
        const seconds_in_days = this.state.duration.days * 86400;
        const seconds_in_hours = this.state.duration.hours * 3600;
        const seconds_in_minutes = this.state.duration.minutes * 60;
        return seconds_in_days + seconds_in_hours + seconds_in_minutes;
    };

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

    handlePolylineChange = polyline => {
        this.setState({ ...this.state, polyline: polyline });
        console.log(this.state.polyline);
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
                            <Col md={6}>
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
                                                    value={this.state.name}
                                                    onChange={e =>
                                                        this.setState({
                                                            ...this.state,
                                                            name: e.target.value
                                                        })
                                                    }
                                                />
                                            </FormGroup>
                                            <FormGroup>
                                                <Label for="maps_url">
                                                    Maps Url{" "}
                                                    <a
                                                        target="_blank"
                                                        href={
                                                            this.state.maps_url
                                                        }
                                                    >
                                                        open
                                                    </a>
                                                </Label>
                                                <Input
                                                    type="text"
                                                    name="maps_url"
                                                    id="maps_url"
                                                    placeholder="Google maps route url"
                                                    value={this.state.maps_url}
                                                    onChange={e =>
                                                        this.setState({
                                                            ...this.state,
                                                            maps_url:
                                                                e.target.value
                                                        })
                                                    }
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
                                                            value={
                                                                this.state
                                                                    .kilometers
                                                            }
                                                            onChange={e =>
                                                                this.setState({
                                                                    ...this
                                                                        .state,
                                                                    kilometers:
                                                                        e.target
                                                                            .value
                                                                })
                                                            }
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
                                        </Form>
                                    </CardBody>
                                    <CardFooter>
                                        <Button
                                            onClick={() =>
                                                this.persistTourInfo()
                                            }
                                            color="primary"
                                        >
                                            Update
                                        </Button>
                                    </CardFooter>
                                </Card>
                            </Col>
                            <Col md={6}>
                                <Card>
                                    <CardBody>
                                        <PolyLineGeoDataMaker
                                            polyline={this.state.polyline}
                                            route_id={this.state.id}
                                            omitPolyArray={polyline =>
                                                this.handlePolylineChange(
                                                    polyline
                                                )
                                            }
                                        />
                                    </CardBody>
                                    <CardFooter>
                                        <Button
                                            color="primary"
                                            className="mt-1"
                                            onClick={() =>
                                                this.persistPolyline()
                                            }
                                        >
                                            Submit
                                        </Button>
                                    </CardFooter>
                                </Card>

                                {/* <Card
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

                                        <Polyline
                                                    path={this.state.polyPath}
                                                    strokeColor="#0000FF"
                                                    strokeOpacity={0.8}
                                                    strokeWeight={5}
                                                />
                                        <InfoWindow
                                            onClose={this.onInfoWindowClose}
                                        >
                                            <div>
                                                <h1>{"henkiehenkie"}</h1>
                                            </div>
                                        </InfoWindow>
                                    </Map>
                                </Card> */}
                            </Col>
                        </Row>
                    </Container>
                </ReactCSSTransitionGroup>
            </Fragment>
        );
    }
}

// const Render = GoogleApiWrapper({
//     apiKey: "AIzaSyB3j2mEdy2UTnuWrzFq3u8T9X21KoMWkSA"
// })(Route);

if (document.getElementById("route")) {
    const element = document.getElementById("route");
    const route = JSON.parse(element.getAttribute("route")); // Data passed in from blade view
    const transits = JSON.parse(element.getAttribute("transits"));
    ReactDOM.render(<Route route={route} transits={transits} />, element);
}
