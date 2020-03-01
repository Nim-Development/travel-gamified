import React, { Component } from "react";
import {
    TextArea,
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

import axios from "axios";

const TOKEN =
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMmQ4YjVjYjk3ZmQyOGQ5NjBiODQ1NjJlNDM4MjAxODQ1OWU2ZTNhNjI1MWUwYTkzZjJkYTliNzkyZDFjMWM4ZmU1MGQ5MjE2OTBkNjM0ZTkiLCJpYXQiOjE1ODMwMDM5OTAsIm5iZiI6MTU4MzAwMzk5MCwiZXhwIjoxNjE0NjI2MzkwLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EAkHTme4k0geE97-CXVF1OFGg6wls8onc-3tLZdXNsKg8br_d6RR9Q5pFUdc8Po-_Kps2-7bOmsqyM6wYmRTugaLJfmqKDgfX_ZC_-menA28IWCmWmiPUICIFb3X8T4HRvOeKdk09Rab_1qiBpSgxedsx6-eOji-zLXmQ07kCo8X4x87Ci8FjChxwWtFTEHEHT1uVmUudPKqE14yXzQvykJESS_lQWxROu8IoTh2nXDunXBzo2f3vGZ9brO1RHhsaMuLJP0PEd8vJXP2ZYasWXSLByQXlVKKeYpklj3q9LKypImu6dPOcXCHyN_tU2BOOT3Ci9_jwE04A8yOtn4OkfDOhKbDZTC8qOMguIzLkIMOtgFkiuTXDhEWoFklxqtg3pojTo0cF6Vp5drJduEvoTY5O0ePyL3LOWW3a139ZmQiCmVhIVQ_bBEAWEH1_xI6HKdAzO3ATxm1la0KxTKkd805pYs00hBK8lLZUnCfnNEk79hIywhy4_tGqrUwn1n8_HGPt2XGYhWmGZsMxVQu4Cp96GC19HFva_3-_6uzbTJxaqCo2llyWv8bqzCMFi6a-zVx3Y2Kqfy0DGrtN5U_PHRE61CK-vyNY51DeEmtbrfqonExSFb-XtQtlQAo5Ca_X6eQCWsLTx3VlIkbl16hdEWDzjyk7cpC1pvM_scsank";
import setAuthorizationToken from "../utils/setAuthorizationToken";

import FetchPolyArray from "./FetchPolyArray";

const GOOGLE_MAPS_APIKEY = "AIzaSyB3j2mEdy2UTnuWrzFq3u8T9X21KoMWkSA";

export default class PolyLineGeoDataMaker extends Component {
    constructor(props) {
        super(props);
        this.state = {
            polyline: props.polyline,
            start: { latitude: null, longitude: null },
            end: { latitude: null, longitude: null },
            waypoints: []
        };
    }

    renderWayPoints() {
        return (
            <div>
                {this.state.waypoints.map((waypoint, index) => {
                    return (
                        <FormGroup key={index}>
                            <Label for="kilometers">
                                Waypoint: {index}{" "}
                                <Button
                                    className="btn btn-danger btn-xs"
                                    onClick={() => this.deleteWaypoint(index)}
                                >
                                    X
                                </Button>
                            </Label>

                            <Row form>
                                <Col md={6}>
                                    <Input
                                        type="number"
                                        placeholder="latitude"
                                        value={waypoint.latitude}
                                        onChange={e =>
                                            this.handleLatitudeWaypointChange(
                                                e.target.value,
                                                index
                                            )
                                        }
                                    />
                                </Col>
                                <Col md={6}>
                                    <Input
                                        type="number"
                                        placeholder="longitude"
                                        value={waypoint.longitude}
                                        onChange={e =>
                                            this.handleLongitudeWaypointChange(
                                                e.target.value,
                                                index
                                            )
                                        }
                                    />
                                </Col>
                            </Row>
                        </FormGroup>
                    );
                })}
            </div>
        );
    }

    addWayPoint() {
        var new_waypoints = this.state.waypoints;
        new_waypoints.push({ latitude: "", longitude: "" });
        this.setState({ ...this.state, waypoints: new_waypoints });
    }

    deleteWaypoint(index) {
        var waypoints = this.state.waypoints;
        waypoints.splice(index, 1);

        this.setState({ ...this.state, waypoints: waypoints });
    }

    renderPolylineObject() {
        return (
            <FormGroup>
                <br></br>
                <Col>
                    <Input
                        type="textarea"
                        name="text"
                        id="exampleText"
                        value={this.props.polyline || ""}
                    />
                </Col>
            </FormGroup>
        );
    }

    handleLatitudeWaypointChange(value, index) {
        var waypoints = this.state.waypoints;
        waypoints[index].latitude = value;
        this.setState({ ...this.state, waypoints: waypoints });
    }

    handleLongitudeWaypointChange(value, index) {
        var waypoints = this.state.waypoints;
        waypoints[index].longitude = value;
        this.setState({ ...this.state, waypoints: waypoints });
    }

    handleLatitudeStartChange(value) {
        var start = this.state.start;
        start.latitude = value;

        this.setState({
            ...this.state,
            start: start
        });
    }

    handleLongitudeStartChange(value) {
        var start = this.state.start;
        start.longitude = value;
        this.setState({ ...this.state, start: start });
    }

    handleLatitudeEndChange(value) {
        var end = this.state.end;
        end.latitude = value;
        this.setState({ ...this.state, end: end });
    }

    handleLongitudeEndChange(value) {
        var end = this.state.end;
        end.longitude = value;
        this.setState({ ...this.state, end: end });
    }

    fetchPolyArray() {
        var start = this.state.start;
        var end = this.state.end;
        var waypoints = !this.state.waypoints ? null : this.state.waypoints;
        var key = GOOGLE_MAPS_APIKEY;

        if (!start || !end) {
            return;
        }

        if (start.latitude && start.longitude) {
            start = `${start.latitude},${start.longitude}`;
        }

        if (end.latitude && end.longitude) {
            end = `${end.latitude},${end.longitude}`;
        }

        // format waypoints
        if (!waypoints || !waypoints.length) {
            waypoints = "";
        } else {
            waypoints = waypoints
                .map(waypoint =>
                    waypoint.latitude && waypoint.longitude
                        ? `${waypoint.latitude},${waypoint.longitude}`
                        : waypoint
                )
                .join("|");
        }

        // makes a google api fetch, and omits a processed GeoJson array that can render a polyline.
        const requestUrl = `https://maps.googleapis.com/maps/api/directions/json?origin=${start}&waypoints=${waypoints}&destination=${end}&key=${key}&mode=driving&language=en&departure_time=now`;

        //maps.googleapis.com/maps/api/directions/json?origin=37.3318456,-122.0296002&waypoints=37.3318456,-122.0296002|37.3318456,-122.0296002|37.3318456,-122.0296002&destination=37.771707,-122.4053769&key=AIzaSyB3j2mEdy2UTnuWrzFq3u8T9X21KoMWkSA&mode=driving&language=en&region=undefined&departure_time=now

        axios
            .get(requestUrl)
            .then(response => response.data)
            .then(json => {
                if (json.status !== "OK") {
                    const errorMessage = json.error_message || "Unknown error";
                    console.log(errorMessage);
                }

                if (json.routes.length) {
                    const route = json.routes[0];
                    const polyline = route.legs.reduce((carry, curr) => {
                        return [...carry, ...this.decode(curr.steps)];
                    }, []);

                    // omit the polyarray to parrent

                    this.props.omitPolyArray(JSON.stringify(polyline));

                    // this.setState({
                    //     ...this.state,
                    //     polyline: JSON.stringify(polyline)
                    // });
                }
                // reduce formatted_response to final polyGeoArray
                // formatted_response
            })
            .catch(err => {
                console.log(err);
            });
    }

    decode(t, e) {
        let points = [];
        for (let step of t) {
            let encoded = step.polyline.points;
            let index = 0,
                len = encoded.length;
            let lat = 0,
                lng = 0;
            while (index < len) {
                let b,
                    shift = 0,
                    result = 0;
                do {
                    b = encoded.charAt(index++).charCodeAt(0) - 63;
                    result |= (b & 0x1f) << shift;
                    shift += 5;
                } while (b >= 0x20);

                let dlat = (result & 1) != 0 ? ~(result >> 1) : result >> 1;
                lat += dlat;
                shift = 0;
                result = 0;
                do {
                    b = encoded.charAt(index++).charCodeAt(0) - 63;
                    result |= (b & 0x1f) << shift;
                    shift += 5;
                } while (b >= 0x20);
                let dlng = (result & 1) != 0 ? ~(result >> 1) : result >> 1;
                lng += dlng;

                points.push({ latitude: lat / 1e5, longitude: lng / 1e5 });
            }
        }
        return points;
    }

    setPolyArray(polyArray) {
        this.setState({ ...this.state, polyline: `${polyArray}` });
    }

    render() {
        return (
            <Card>
                <CardBody>
                    <Row form>
                        <Col md={6}>
                            <FormGroup>
                                <Label for="kilometers">Start</Label>
                                <Row form>
                                    <Col md={6}>
                                        <Input
                                            type="number"
                                            placeholder="latitude"
                                            value={
                                                this.state.start.latitude || ""
                                            }
                                            onChange={e =>
                                                this.handleLatitudeStartChange(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </Col>
                                    <Col md={6}>
                                        <Input
                                            type="number"
                                            placeholder="longitude"
                                            value={
                                                this.state.start.longitude || ""
                                            }
                                            onChange={e =>
                                                this.handleLongitudeStartChange(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </Col>
                                </Row>
                            </FormGroup>
                        </Col>
                        <Col md={6}>
                            <FormGroup>
                                <Label for="kilometers">Finish</Label>
                                <Row form>
                                    <Col md={6}>
                                        <Input
                                            type="number"
                                            name="kilometers"
                                            id="kilometers"
                                            placeholder="latitude"
                                            value={
                                                this.state.end.latitude || ""
                                            }
                                            onChange={e =>
                                                this.handleLatitudeEndChange(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </Col>
                                    <Col md={6}>
                                        <Input
                                            type="number"
                                            name="kilometers"
                                            id="kilometers"
                                            placeholder="longitude"
                                            value={
                                                this.state.end.longitude || ""
                                            }
                                            onChange={e =>
                                                this.handleLongitudeEndChange(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </Col>
                                </Row>
                            </FormGroup>
                        </Col>
                        <Col md={12}>
                            {this.renderWayPoints()}
                            <Button onClick={() => this.addWayPoint()}>
                                Add waypoint
                            </Button>
                        </Col>{" "}
                        <Col md={12}>
                            <hr></hr>{" "}
                            <Button
                                className="btn btn-success"
                                onClick={() => this.fetchPolyArray()}
                            >
                                Generate
                            </Button>
                            {this.renderPolylineObject()}
                        </Col>
                    </Row>
                </CardBody>
            </Card>
        );
    }
}
