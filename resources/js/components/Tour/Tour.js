import React, { Fragment } from "react";
import ReactDOM from "react-dom";

import ReactCSSTransitionGroup from "react-addons-css-transition-group";
import { Row, Col, Card, CardBody, CardTitle, Container } from "reactstrap";

import setAuthorizationToken from "../utils/setAuthorizationToken";

import axios from "axios";

import {
    VerticalTimeline,
    VerticalTimelineElement
} from "react-vertical-timeline-component";

import CityPlayfieldCard from "./ListCards/PlayfieldCard/CityPlayfieldCard";
import RoutePlayfieldCard from "./ListCards/PlayfieldCard/RoutePlayfieldCard";
import TransitPlayfieldCard from "./ListCards/PlayfieldCard/TransitPlayfieldCard";

import InsertPlayfield from "./ListCards/InsertCard/InsertPlayfield";

import ControlPanel from "./ControlPanel";

class Tour extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            tour: props.tour.data,
            itineraries: props.itineraries.data,
            cities: props.cities.data,
            routes: props.routes.data,
            transits: props.transits.data
        };

        this.addPlayfieldPicker = this.addPlayfieldPicker.bind(this);
        this.addPopulatedPlayfield = this.addPopulatedPlayfield.bind(this);
        this.deleteItinerary = this.deleteItinerary.bind(this);
    }

    componentDidMount() {
        // fetch initial state
        axios.get();
    }

    // Add NULL to the itineraries array, this will render a new playfield picker.
    addPlayfieldPicker(index) {
        const itineraries = this.state.itineraries;
        itineraries.splice(index + 1, 0, null);
        this.setState({ itineraries: itineraries });
    }

    addPopulatedPlayfield(playfield, type, index) {
        const body = {
            tour_id: this.state.tour.id,
            step: index,
            duration: 12.34,
            playfield_type: type,
            playfield_id: playfield.id
        };
        setAuthorizationToken(
            `eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDg3Y2E2ZjgyNDRkMTI0OTNiOGI4ZWI4NTQyYzhkNGRhYTIwODAwY2VlZDA5ZmY2YmQ4MWM0YjhlZjgzYmQxYTMyZTUxZmM4M2ZhZWI3MGMiLCJpYXQiOjE1ODE0NDIyNjksIm5iZiI6MTU4MTQ0MjI2OSwiZXhwIjoxNjEzMDY0NjY5LCJzdWIiOiIyMiIsInNjb3BlcyI6W119.qZetPnhT4RrcFNTbmpzNfOe5rYPuq6UY6N0rgagdNzN_hbwJx0-9A1lQFXQgWipuvnCEUIeCYcJSnpPaVjPFs5U4ooP193iCz2OPWYj3CHOuhWvHkiSR3c7upljJkUgYiKlyQq_w_0dGjoQFf5WIjdHG1ghz8bugh71UfbmwGQBL27izhbOecUkGztTdXISIjDSPByzU5EeARrYzYcf5I7GgFkMq66M4SWK-Pn-9Hxs9TRPeh1XS1sYJYLyPFZrsj1XAHoR5SE4zloYA2hp1tSgw0Y2P-VepKrFjaTFYU0mQruXg_a2_uH5__h69u2xj3qlhCEP2eYXxOM49PIB3_pUQ5i6ZyDAm6RPRcDG4NAz6iUKzVW6M5mb8_n_zIqEJfuA5KWYd0847DtN0j61pFkeK2iCtFJtiQ3zGPqyR51V7xKUzDDHHkN6Lr-6GxVqEhuvB4V7X5q_eiVlBKqDCqaFrcnkmdgRz_7GSXDHtivh5CyOrblHU8SphY3qa89N4Ab12MqzOysR67w-MphfA6rvx0FslOWSC_1y6jDVy8FNQSxbXNZJfr7c8LGR6hxpXACrAYXXlAN1mP199PC-WwO8dUpPwrGq-j6gZn4uG6lu0zGwwrFuX4VJeHlPaRGWmKWoulPkSOjivHncLxtG7ODrlrV7M0K9a32u3fWCf8_Y`
        );
        // NOTE!: STILL NEED TO MAKE THE BACKEND SO THAT IT PROPERLY HANDLES THE STEPS!.
        axios
            .post(`http://127.0.0.1:8000/api/admin/itineraries`, body)
            .then(res => {
                // Update the state (add new itinerary item)
                const newItineraries = this.state.itineraries;
                newItineraries.splice(index, 1, res.data.data);
                this.setState({
                    ...this.state,
                    itineraries: newItineraries
                });
            });
    }

    deleteItinerary(index, id) {
        if (id) {
            // there is an id available, so we should persit deletion to databse
            setAuthorizationToken(
                `eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDg3Y2E2ZjgyNDRkMTI0OTNiOGI4ZWI4NTQyYzhkNGRhYTIwODAwY2VlZDA5ZmY2YmQ4MWM0YjhlZjgzYmQxYTMyZTUxZmM4M2ZhZWI3MGMiLCJpYXQiOjE1ODE0NDIyNjksIm5iZiI6MTU4MTQ0MjI2OSwiZXhwIjoxNjEzMDY0NjY5LCJzdWIiOiIyMiIsInNjb3BlcyI6W119.qZetPnhT4RrcFNTbmpzNfOe5rYPuq6UY6N0rgagdNzN_hbwJx0-9A1lQFXQgWipuvnCEUIeCYcJSnpPaVjPFs5U4ooP193iCz2OPWYj3CHOuhWvHkiSR3c7upljJkUgYiKlyQq_w_0dGjoQFf5WIjdHG1ghz8bugh71UfbmwGQBL27izhbOecUkGztTdXISIjDSPByzU5EeARrYzYcf5I7GgFkMq66M4SWK-Pn-9Hxs9TRPeh1XS1sYJYLyPFZrsj1XAHoR5SE4zloYA2hp1tSgw0Y2P-VepKrFjaTFYU0mQruXg_a2_uH5__h69u2xj3qlhCEP2eYXxOM49PIB3_pUQ5i6ZyDAm6RPRcDG4NAz6iUKzVW6M5mb8_n_zIqEJfuA5KWYd0847DtN0j61pFkeK2iCtFJtiQ3zGPqyR51V7xKUzDDHHkN6Lr-6GxVqEhuvB4V7X5q_eiVlBKqDCqaFrcnkmdgRz_7GSXDHtivh5CyOrblHU8SphY3qa89N4Ab12MqzOysR67w-MphfA6rvx0FslOWSC_1y6jDVy8FNQSxbXNZJfr7c8LGR6hxpXACrAYXXlAN1mP199PC-WwO8dUpPwrGq-j6gZn4uG6lu0zGwwrFuX4VJeHlPaRGWmKWoulPkSOjivHncLxtG7ODrlrV7M0K9a32u3fWCf8_Y`
            );
            // NOTE!: STILL NEED TO MAKE THE BACKEND SO THAT IT PROPERLY HANDLES THE STEPS!.
            axios
                .delete(`http://127.0.0.1:8000/api/admin/itineraries/${id}`)
                .then(res => {
                    // Update the state (remove itinerary item at id)
                    const newItineraries = this.state.itineraries;
                    newItineraries.splice(index, 1); // remove at index, remotv 1 item.
                    this.setState({
                        ...this.state,
                        itineraries: newItineraries
                    });
                });
        } else {
            // there is no id available, so this item only exists in the component state (not in database)
            // Update the state (remove itinerary item at id)
            const newItineraries = this.state.itineraries;
            newItineraries.splice(index, 1); // remove at index, remotv 1 item.
            this.setState({
                ...this.state,
                itineraries: newItineraries
            });
        }
    }

    changeSort(treeData) {
        // making a { id: .., step: ... } body that specifies the step index of each itinerary id
        const body = {
            sort_order: {
                ...treeData.map(function(item, index) {
                    return { id: item.id, step: index };
                })
            }
        };

        // // there is an id available, so we should persit deletion to databse
        setAuthorizationToken(
            `eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDg3Y2E2ZjgyNDRkMTI0OTNiOGI4ZWI4NTQyYzhkNGRhYTIwODAwY2VlZDA5ZmY2YmQ4MWM0YjhlZjgzYmQxYTMyZTUxZmM4M2ZhZWI3MGMiLCJpYXQiOjE1ODE0NDIyNjksIm5iZiI6MTU4MTQ0MjI2OSwiZXhwIjoxNjEzMDY0NjY5LCJzdWIiOiIyMiIsInNjb3BlcyI6W119.qZetPnhT4RrcFNTbmpzNfOe5rYPuq6UY6N0rgagdNzN_hbwJx0-9A1lQFXQgWipuvnCEUIeCYcJSnpPaVjPFs5U4ooP193iCz2OPWYj3CHOuhWvHkiSR3c7upljJkUgYiKlyQq_w_0dGjoQFf5WIjdHG1ghz8bugh71UfbmwGQBL27izhbOecUkGztTdXISIjDSPByzU5EeARrYzYcf5I7GgFkMq66M4SWK-Pn-9Hxs9TRPeh1XS1sYJYLyPFZrsj1XAHoR5SE4zloYA2hp1tSgw0Y2P-VepKrFjaTFYU0mQruXg_a2_uH5__h69u2xj3qlhCEP2eYXxOM49PIB3_pUQ5i6ZyDAm6RPRcDG4NAz6iUKzVW6M5mb8_n_zIqEJfuA5KWYd0847DtN0j61pFkeK2iCtFJtiQ3zGPqyR51V7xKUzDDHHkN6Lr-6GxVqEhuvB4V7X5q_eiVlBKqDCqaFrcnkmdgRz_7GSXDHtivh5CyOrblHU8SphY3qa89N4Ab12MqzOysR67w-MphfA6rvx0FslOWSC_1y6jDVy8FNQSxbXNZJfr7c8LGR6hxpXACrAYXXlAN1mP199PC-WwO8dUpPwrGq-j6gZn4uG6lu0zGwwrFuX4VJeHlPaRGWmKWoulPkSOjivHncLxtG7ODrlrV7M0K9a32u3fWCf8_Y`
        );

        // persist sortorder change
        axios
            .put(
                `http://127.0.0.1:8000/api/admin/itineraries/sort/${this.state.tour.id}`,
                body
            )
            .then(res => {
                // on success, simply update the local store with the treeData param :)!
                this.setState({
                    ...this.state,
                    itineraries: treeData
                });
            })
            .catch(e => {
                console.log(e);
            });
    }

    renderItinerary(itinerary, index) {
        if (!itinerary) {
            // check null
            // return a empty 'selector' card (which is a card inside the itinerary that still has to be populated with a playfield.)
            return (
                <div>
                    <VerticalTimelineElement className="vertical-timeline-item">
                        {/* A card / wizzard that lets you insert a new playfield into the itinerary */}
                        <InsertPlayfield
                            index={index}
                            cities={this.state.cities}
                            routes={this.state.routes}
                            transits={this.state.transits}
                            omitPlayfield={this.addPopulatedPlayfield}
                            omitDelete={this.deleteItinerary}
                        />
                    </VerticalTimelineElement>
                </div>
            );
        }

        switch (itinerary.playfield.type) {
            case "city":
                // return city card
                return (
                    <CityPlayfieldCard
                        id={itinerary.id}
                        index={index}
                        omitDelete={this.deleteItinerary}
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        duration={itinerary.duration}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                    />
                );
            case "transit":
                // return transit card
                return (
                    <TransitPlayfieldCard
                        id={itinerary.id}
                        index={index}
                        omitDelete={this.deleteItinerary}
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        duration={itinerary.duration}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                    />
                );
            case "route":
                // return transit card
                return (
                    <RoutePlayfieldCard
                        id={itinerary.id}
                        index={index}
                        omitDelete={this.deleteItinerary}
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        duration={itinerary.duration}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                    />
                );
            default:
                break;
        }
    }

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
                            {/* The tour description card (top card) */}
                            <Col md="12">
                                <Card className="main-card mb-3">
                                    <CardBody>
                                        <CardTitle>
                                            {this.state.tour.name}
                                        </CardTitle>
                                        <p>
                                            Duration: {this.state.tour.duration}{" "}
                                            hours
                                        </p>
                                        <p>
                                            jd che sdhua uhdf uhsad iufh aisudh
                                            fiusadhf uihad fiuh asiudhf iuashdf
                                            iuhasd ufhas fuihaiusd f falseasd
                                            falseads fh asduhf asdhf uiashdf
                                            iuhasd fiuh asdiuhf iusadfiuhsda
                                            ufsuiadfuhsadufh sauhdf uhsaf duha
                                            fusdh fuhas iufh asuihdfs
                                        </p>
                                    </CardBody>
                                </Card>
                            </Col>

                            {/* The itinerary list with playfield cards */}
                            <Col md="12" lg="8">
                                <Card className="main-card mb-3 danger">
                                    <CardBody>
                                        <CardTitle>Itinerary</CardTitle>
                                        <VerticalTimeline
                                            className="vertical-time-icons"
                                            layout="1-column"
                                        >
                                            {this.state.itineraries.map(
                                                (itinerary, index) => {
                                                    return (
                                                        <div>
                                                            {/* render the playfield card elements */}
                                                            {this.renderItinerary(
                                                                itinerary,
                                                                index
                                                            )}
                                                            <VerticalTimelineElement className="vertical-timeline-item">
                                                                <Row>
                                                                    <Col
                                                                        lg="12"
                                                                        className="text-center"
                                                                    >
                                                                        <button
                                                                            onClick={() =>
                                                                                this.addPlayfieldPicker(
                                                                                    index
                                                                                )
                                                                            }
                                                                            className="btn btn-outline-primary"
                                                                        >
                                                                            Add
                                                                            Playfield
                                                                        </button>
                                                                    </Col>
                                                                </Row>
                                                            </VerticalTimelineElement>
                                                        </div>
                                                    );
                                                }
                                            )}
                                        </VerticalTimeline>
                                    </CardBody>
                                </Card>
                            </Col>

                            {/* Sortable tree */}
                            <Col md="12" lg="4">
                                <ControlPanel
                                    itineraries={this.state.itineraries}
                                    omitChangeSort={treeData =>
                                        this.changeSort(treeData)
                                    }
                                />
                            </Col>
                        </Row>
                    </Container>
                </ReactCSSTransitionGroup>
            </Fragment>
        );
    }
}

if (document.getElementById("tour")) {
    const element = document.getElementById("tour");

    const tour = JSON.parse(element.getAttribute("tour")); // Data passed in from blade view
    const itineraries = JSON.parse(element.getAttribute("itineraries"));
    const cities = JSON.parse(element.getAttribute("cities"));
    const routes = JSON.parse(element.getAttribute("routes"));
    const transits = JSON.parse(element.getAttribute("transits"));

    ReactDOM.render(
        <Tour
            tour={tour}
            itineraries={itineraries}
            cities={cities}
            routes={routes}
            transits={transits}
        />,
        element
    );
}
