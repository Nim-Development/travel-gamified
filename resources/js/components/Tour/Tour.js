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
import { changeNodeAtPath } from "react-sortable-tree";

const TOKEN =
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTEzYThhZWExMjFkMGU4Yjc3NzQ0MTJlYjY4ZWRiZDFkYjMzOTRjOTk2MDdhZmQ0ZWMwNDQyNzlhNTE2YTZhNjJiZDBiMDlkNmJmOTFlZGMiLCJpYXQiOjE1ODE1NTIyNDYsIm5iZiI6MTU4MTU1MjI0NiwiZXhwIjoxNjEzMTc0NjQ2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TL4QFNaw4Wnee7ySD4c8fyrsyWUWj5lnCrZxfoGCH_HNOxLkfEyS7aTnmj8OQ3e5HY7CXPjUZHVhxNSv4PywDMFbaJ6-bVzW-7F8IQNNjOxahHA4HDOvlb8bwdRiZF50U1LNwl8bCJSyzdFatD67d5XgglMsRpEwiMYAgP1yF_0Hl0UGgEam0aZAed0bda20O5dIkZ-vOB1eoq69-paxsG2x8X8sKYMOL4HBWHpKCsAjiSxxrWB7-xTgwk2OkClb-zIEIJ4sdP3Qm1ARGidHGxwNDrPYmSt5vCcv6ZqS0EEMw78Udj8P3PanW45XDTvnYBWT5afmSlnNmomNsSTuLI1gQqiruvj1M5XEaJPWG_0O4xnGEz1W_vcunuOvl1T3cjwkFjM2DV3Db6uc9BXO0F4J5etyEvWr2VQzU8XhI-SriJ_PWO8iPKj6YduWw6aHC4OCCh8RiuZPi0QS53enNlBkUthLorWHirxAvKcN7QwQJYks6xhEiT5EOaAwSjeKquFxi6LhxnD_YtIiF2IX_dom4KbtyLwIvLrC9sqVdzfGbHFHHErMfE5p-o0myR0OwjB_IdfQGZaQCQmjUxaVF5CvYtRg892osQECd8IYI7_1xtvIA6EwJK6kLW6Ie6QOBi6wlntBmQB3s-YCsQxAY_XnxzTYDRIYpbXioNwUENA";

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
            days: 0,
            hours: 0,
            minutes: 0,
            playfield_type: type,
            playfield_id: playfield.id
        };

        setAuthorizationToken(TOKEN);
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
            setAuthorizationToken(TOKEN);
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
        setAuthorizationToken(TOKEN);

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

    updateTourDuration() {
        const itineraries = this.state.itineraries;

        var totalDays = itineraries.reduce(function(prev, cur) {
            return prev + cur.duration.days;
        }, 0);

        // get sum of msgCount prop across all objects in array
        var totalHours = itineraries.reduce(function(prev, cur) {
            return prev + cur.duration.hours;
        }, 0);

        // get sum of msgCount prop across all objects in array
        var totalMinutes = itineraries.reduce(function(prev, cur) {
            return prev + cur.duration.minutes;
        }, 0);

        // reduce minutes to hours
        var minutesToHours = Math.floor(totalMinutes / 60);
        var minutesInHours = minutesToHours * 60;
        var remainingMinutes = totalMinutes - minutesInHours;

        totalHours = totalHours + minutesToHours; // new state.hours
        totalMinutes = totalMinutes + remainingMinutes; // new state.minutes

        // reduce hours to days
        var hoursToDays = Math.floor(totalHours / 24);
        var hoursInDays = hoursToDays * 24;
        var remainingHours = totalHours - hoursInDays;

        totalDays = totalDays + hoursToDays; // new state.days

        const tour = {
            ...this.state.tour,
            duration: {
                days: totalDays,
                hours: remainingHours,
                minutes: remainingMinutes
            }
        };

        // Set new total tour duration in state
        this.setState({
            ...this.state,
            tour: tour
        });
    }

    updateItineraryDays(days, index) {
        // update itinerary.duration.days at index
        var itineraries = this.state.itineraries;
        itineraries[index].duration.days = days;
        this.setState({
            ...this.state,
            itineraries: itineraries
        });

        this.updateTourDuration();
    }
    updateItineraryHours(hours, index) {
        // update itinerary.duration.hours at index
        var itineraries = this.state.itineraries;
        itineraries[index].duration.hours = hours;
        this.setState({
            ...this.state,
            itineraries: itineraries
        });

        this.updateTourDuration();
    }
    updateItineraryMinutes(minutes, index) {
        // update itinerary.duration.minutes at index
        var itineraries = this.state.itineraries;
        itineraries[index].duration.minutes = minutes;
        this.setState({
            ...this.state,
            itineraries: itineraries
        });

        this.updateTourDuration();
    }

    handleNewPlayfield = (playfield, type, index) => {
        // there is an id available, so we should persit deletion to databse
        setAuthorizationToken(TOKEN);
        console.log(`Index: ${index}`);
        // send a axios create request to make a new playfield
        switch (type) {
            case "city":
                axios
                    .post(`http://127.0.0.1:8000/api/admin/cities`, playfield)
                    .then(res => {
                        this.addPopulatedPlayfield(res.data.data, type, index);
                    });
                break;
            case "route":
                break;
            case "itinerary":
                break;
            default:
                break;
        }

        // Persist the populated playfield to the database as an itinerary, and add the itinerary to the local state.
        // addPopulatedPlayfield(playfield, type, index);

        // console.log(`Playfield: ${playfield}, Index: ${index}`);
    };

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
                            omitNewPlayfield={(playfield, type, index) =>
                                this.handleNewPlayfield(playfield, type, index)
                            }
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
                        // update the itinerary days at index in the container component
                        omitItineraryDays={(days, index) =>
                            this.updateItineraryDays(days, index)
                        }
                        omitItineraryHours={(hours, index) =>
                            this.updateItineraryHours(hours, index)
                        }
                        omitItineraryMinutes={(minutes, index) =>
                            this.updateItineraryMinutes(minutes, index)
                        }
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        days={itinerary.duration.days}
                        hours={itinerary.duration.hours}
                        minutes={itinerary.duration.minutes}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                        challenges={[
                            {
                                name: "Crazy city dive",
                                type: "text answere",
                                created_at: "12 feb 2049"
                            },
                            {
                                name: "Food mania",
                                type: "media upload",
                                created_at: "12 jan 1988"
                            },
                            {
                                name: "Faster than this?!",
                                type: "multiple choice",
                                created_at: "14 agust 2044"
                            }
                        ]}
                        // challenges={itinerary.challenges} << EVENTUALY
                    />
                );
            case "transit":
                // return transit card
                return (
                    <TransitPlayfieldCard
                        id={itinerary.id}
                        index={index}
                        omitDelete={this.deleteItinerary}
                        omitItineraryDays={(days, index) =>
                            this.updateItineraryDays(days, index)
                        }
                        omitItineraryHours={(hours, index) =>
                            this.updateItineraryHours(hours, index)
                        }
                        omitItineraryMinutes={(minutes, index) =>
                            this.updateItineraryMinutes(minutes, index)
                        }
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        maps_urls={[
                            {
                                name: "Bac Kan to Ha Giang 1",
                                url:
                                    "https://www.google.com/maps/dir/B%E1%BA%AFc+K%E1%BA%A1n,+Vietnam/H%C3%A0+Giang,+Ha+Giang,+Vietnam/@22.2475645,104.783129,9z/data=!4m14!4m13!1m5!1m1!1s0x36cae0484a85eb4d:0xbf0390482b496ed0!2m2!1d105.876004!2d22.3032923!1m5!1m1!1s0x36cc79b180b4239d:0xb7a373a73bc23544!2m2!1d104.9784494!2d22.8025588!3e0"
                            },
                            {
                                name: "Bac Kan to Ha Giang 2",
                                url:
                                    "https://www.google.com/maps/dir/B%E1%BA%AFc+K%E1%BA%A1n,+Vietnam/H%C3%A0+Giang,+Ha+Giang,+Vietnam/@22.2475645,104.783129,9z/data=!4m15!4m14!1m5!1m1!1s0x36cae0484a85eb4d:0xbf0390482b496ed0!2m2!1d105.876004!2d22.3032923!1m5!1m1!1s0x36cc79b180b4239d:0xb7a373a73bc23544!2m2!1d104.9784494!2d22.8025588!3e0!5i1"
                            },
                            {
                                name: "Bac Kan to Ha Giang 3",
                                url:
                                    "https://www.google.com/maps/dir/B%E1%BA%AFc+K%E1%BA%A1n,+Vietnam/H%C3%A0+Giang,+Ha+Giang,+Vietnam/@22.2475645,104.783129,9z/data=!4m15!4m14!1m5!1m1!1s0x36cae0484a85eb4d:0xbf0390482b496ed0!2m2!1d105.876004!2d22.3032923!1m5!1m1!1s0x36cc79b180b4239d:0xb7a373a73bc23544!2m2!1d104.9784494!2d22.8025588!3e0!5i2"
                            }
                        ]}
                        days={itinerary.duration.days}
                        hours={itinerary.duration.hours}
                        minutes={itinerary.duration.minutes}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                        challenges={[
                            {
                                name: "Crazy city dive",
                                type: "text answere",
                                created_at: "12 feb 2049"
                            },
                            {
                                name: "Food mania",
                                type: "media upload",
                                created_at: "12 jan 1988"
                            },
                            {
                                name: "Faster than this?!",
                                type: "multiple choice",
                                created_at: "14 agust 2044"
                            }
                        ]}
                    />
                );
            case "route":
                // return transit card
                return (
                    <RoutePlayfieldCard
                        id={itinerary.id}
                        index={index}
                        omitDelete={this.deleteItinerary}
                        omitItineraryDays={(days, index) =>
                            this.updateItineraryDays(days, index)
                        }
                        omitItineraryHours={(hours, index) =>
                            this.updateItineraryHours(hours, index)
                        }
                        omitItineraryMinutes={(minutes, index) =>
                            this.updateItineraryMinutes(minutes, index)
                        }
                        name={itinerary.playfield.name}
                        type={itinerary.playfield.type}
                        maps_url={itinerary.maps_url}
                        days={itinerary.duration.days}
                        hours={itinerary.duration.hours}
                        minutes={itinerary.duration.minutes}
                        created_at={itinerary.created_at}
                        text={itinerary.text}
                        challenges={[
                            {
                                name: "Crazy city dive",
                                type: "text answere",
                                created_at: "12 feb 2049"
                            },
                            {
                                name: "Food mania",
                                type: "media upload",
                                created_at: "12 jan 1988"
                            },
                            {
                                name: "Faster than this?!",
                                type: "multiple choice",
                                created_at: "14 agust 2044"
                            }
                        ]}
                        route
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
                                            Days:{" "}
                                            {this.state.tour.duration.days} ,
                                            Hours:{" "}
                                            {this.state.tour.duration.hours} ,
                                            Minutes:{" "}
                                            {this.state.tour.duration.minutes}
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
