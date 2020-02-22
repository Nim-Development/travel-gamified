import React, { Component } from "react";
import {
    Row,
    Col,
    Card,
    CardBody,
    UncontrolledButtonDropdown,
    DropdownToggle,
    DropdownMenu,
    DropdownItem,
    Button,
    Collapse,
    CardHeader,
    ListGroup,
    ListGroupItem
} from "reactstrap";

import ReactTable from "react-table";

import { Progress } from "react-sweet-progress";
import { VerticalTimelineElement } from "react-vertical-timeline-component";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faMapPin } from "@fortawesome/free-solid-svg-icons";

import Slider, { createSliderWithTooltip } from "rc-slider";
const SliderWithTooltip = createSliderWithTooltip(Slider);

export default class RoutePlayfieldCard extends Component {
    constructor(props) {
        super(props);

        this.state = {
            accordion: [false, false, false]
        };
    }

    toggleAccordion = tab => {
        const newState = this.state.accordion;
        newState[tab] = !newState[tab];

        this.setState({
            accordion: newState
        });
    };

    handleDurationSliderDays = days => {
        // update the itinerary days at index in the container component
        this.props.omitItineraryDays(days, this.props.index);
    };
    handleDurationSliderHours = hours => {
        this.props.omitItineraryHours(hours, this.props.index);
    };
    handleDurationSliderMinutes = minutes => {
        this.props.omitItineraryMinutes(minutes, this.props.index);
    };

    render() {
        const {
            id,
            index,
            omitDelete,
            name,
            duration,
            type,
            created_at,
            text
        } = this.props;

        return (
            <div>
                <VerticalTimelineElement
                    className="vertical-timeline-item"
                    icon={
                        <div className="timeline-icon border-warning bg-warning">
                            <FontAwesomeIcon
                                icon={faMapPin}
                                className="text-white"
                            />
                        </div>
                    }
                >
                    <Card
                        className="main-card mb-3"
                        style={{
                            boxBhadow: "1px 3px 1px red"
                        }}
                    >
                        <CardHeader>
                            {name}
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
                                        <DropdownItem
                                            onClick={() =>
                                                omitDelete(index, id)
                                            }
                                        >
                                            Are u sure?
                                        </DropdownItem>
                                    </DropdownMenu>
                                </UncontrolledButtonDropdown>
                            </div>
                        </CardHeader>
                        <CardBody>
                            <p>
                                Duration: {duration}, Playfield type: {type},
                                Playfield name: {name}, created at: {created_at}
                                {text}
                            </p>
                            <Row>
                                <Col lg={12}>
                                    <div
                                        id="accordion"
                                        className="accordion-wrapper mb-3"
                                    >
                                        <Card>
                                            <CardHeader id="headingOne">
                                                <Button
                                                    block
                                                    color="link"
                                                    className="text-left m-0 p-0"
                                                    onClick={() =>
                                                        this.toggleAccordion(0)
                                                    }
                                                    aria-expanded={
                                                        this.state.accordion[0]
                                                    }
                                                    aria-controls="collapseOne"
                                                >
                                                    <h5 className="m-0 p-0">
                                                        Playfield facts
                                                    </h5>
                                                </Button>
                                            </CardHeader>
                                            <Collapse
                                                isOpen={this.state.accordion[0]}
                                                data-parent="#accordion"
                                                id="collapseOne"
                                                aria-labelledby="headingOne"
                                            >
                                                <CardBody>
                                                    <Col lg={{ size: 12 }}>
                                                        <ListGroup flush>
                                                            <ListGroupItem>
                                                                <div className="widget-content p-0">
                                                                    <div className="widget-content-wrapper">
                                                                        <div className="widget-content-left mr-3">
                                                                            <div className="icon-wrapper m-0">
                                                                                <div className="progress-circle-wrapper">
                                                                                    <Progress
                                                                                        type="circle"
                                                                                        percent={
                                                                                            82
                                                                                        }
                                                                                        width="100%"
                                                                                        theme={{
                                                                                            active: {
                                                                                                trailColor:
                                                                                                    "#e1e1e1",
                                                                                                color:
                                                                                                    "#3ac47d"
                                                                                            }
                                                                                        }}
                                                                                    />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div className="widget-content-left">
                                                                            <div className="widget-heading">
                                                                                January
                                                                                Sales
                                                                            </div>
                                                                            <div className="widget-subheading">
                                                                                Lorem
                                                                                ipsum
                                                                                dolor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </ListGroupItem>
                                                            <ListGroupItem>
                                                                <div className="widget-content p-0">
                                                                    <div className="widget-content-wrapper">
                                                                        <div className="widget-content-left mr-3">
                                                                            <div className="icon-wrapper m-0">
                                                                                <div className="progress-circle-wrapper">
                                                                                    <Progress
                                                                                        type="circle"
                                                                                        percent={
                                                                                            47
                                                                                        }
                                                                                        width="100%"
                                                                                        theme={{
                                                                                            active: {
                                                                                                trailColor:
                                                                                                    "#e1e1e1",
                                                                                                color:
                                                                                                    "#f7b924"
                                                                                            }
                                                                                        }}
                                                                                    />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div className="widget-content-left">
                                                                            <div className="widget-heading">
                                                                                February
                                                                                Sales
                                                                            </div>
                                                                            <div className="widget-subheading">
                                                                                Maecenas
                                                                                tempus,
                                                                                tellus
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </ListGroupItem>
                                                            <ListGroupItem>
                                                                <div className="widget-content p-0">
                                                                    <div className="widget-content-wrapper">
                                                                        <div className="widget-content-left mr-3">
                                                                            <div className="icon-wrapper m-0">
                                                                                <div className="progress-circle-wrapper">
                                                                                    <Progress
                                                                                        type="circle"
                                                                                        percent={
                                                                                            62
                                                                                        }
                                                                                        width="100%"
                                                                                        theme={{
                                                                                            active: {
                                                                                                trailColor:
                                                                                                    "#e1e1e1",
                                                                                                color:
                                                                                                    "#d92550"
                                                                                            }
                                                                                        }}
                                                                                    />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div className="widget-content-left">
                                                                            <div className="widget-heading">
                                                                                March
                                                                                Sales
                                                                            </div>
                                                                            <div className="widget-subheading">
                                                                                Donec
                                                                                vitae
                                                                                sapien
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </ListGroupItem>
                                                        </ListGroup>
                                                    </Col>
                                                </CardBody>
                                            </Collapse>
                                        </Card>
                                        <Card>
                                            <CardHeader
                                                className="b-radius-0"
                                                id="headingTwo"
                                            >
                                                <Button
                                                    block
                                                    color="link"
                                                    className="text-left m-0 p-0"
                                                    onClick={() =>
                                                        this.toggleAccordion(1)
                                                    }
                                                    aria-expanded={
                                                        this.state.accordion[1]
                                                    }
                                                    aria-controls="collapseTwo"
                                                >
                                                    <h5 className="m-0 p-0">
                                                        Challenges
                                                    </h5>
                                                </Button>
                                            </CardHeader>
                                            <Collapse
                                                isOpen={this.state.accordion[1]}
                                                data-parent="#accordion"
                                                id="collapseTwo"
                                            >
                                                <CardBody>
                                                    {/* Table */}
                                                    <Col lg={12}>
                                                        <ReactTable
                                                            data={
                                                                this.props
                                                                    .challenges
                                                            }
                                                            minRows={5}
                                                            columns={[
                                                                {
                                                                    columns: [
                                                                        {
                                                                            Header:
                                                                                "Name",
                                                                            accessor:
                                                                                "name",
                                                                            Cell: row => (
                                                                                <div>
                                                                                    <div className="widget-content p-0">
                                                                                        <div className="widget-content-wrapper">
                                                                                            <div className="widget-content-left mr-3">
                                                                                                <div className="widget-content-left">
                                                                                                    {/* <img
                                                                                    width={
                                                                                        52
                                                                                    }
                                                                                    className="rounded-circle"
                                                                                    src={
                                                                                        avatar2
                                                                                    }
                                                                                    alt=""
                                                                                /> */}
                                                                                                </div>
                                                                                            </div>
                                                                                            <div className="widget-content-left flex2">
                                                                                                <div className="widget-heading">
                                                                                                    {
                                                                                                        row.value
                                                                                                    }
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            )
                                                                        },
                                                                        {
                                                                            Header:
                                                                                "Type",
                                                                            accessor:
                                                                                "type"
                                                                        },
                                                                        {
                                                                            Header:
                                                                                "Created At",
                                                                            accessor:
                                                                                "created_at"
                                                                        }
                                                                    ]
                                                                },
                                                                {
                                                                    columns: [
                                                                        {
                                                                            Header:
                                                                                "Actions",
                                                                            accessor:
                                                                                "actions",
                                                                            Cell: row => (
                                                                                <div className="d-block w-100 text-center">
                                                                                    <UncontrolledButtonDropdown>
                                                                                        <DropdownToggle
                                                                                            caret
                                                                                            className="btn-icon btn-icon-only btn btn-link"
                                                                                            color="link"
                                                                                        >
                                                                                            <i className="lnr-menu-circle btn-icon-wrapper" />
                                                                                        </DropdownToggle>
                                                                                        <DropdownMenu className="rm-pointers dropdown-menu-hover-link">
                                                                                            <DropdownItem
                                                                                                header
                                                                                            >
                                                                                                Action
                                                                                            </DropdownItem>
                                                                                            <DropdownItem
                                                                                            // onClick={() =>
                                                                                            //     this.openTour(
                                                                                            //         row
                                                                                            //             .original
                                                                                            //             .id
                                                                                            //     )
                                                                                            // }
                                                                                            >
                                                                                                <i className="dropdown-icon lnr-inbox">
                                                                                                    {" "}
                                                                                                </i>
                                                                                                <span>
                                                                                                    Details
                                                                                                </span>
                                                                                            </DropdownItem>
                                                                                            <DropdownItem>
                                                                                                <i className="dropdown-icon lnr-file-empty">
                                                                                                    {" "}
                                                                                                </i>
                                                                                                <span>
                                                                                                    Delete
                                                                                                </span>
                                                                                            </DropdownItem>
                                                                                            <DropdownItem
                                                                                                divider
                                                                                            />
                                                                                            <DropdownItem>
                                                                                                <i className="dropdown-icon lnr-picture">
                                                                                                    {" "}
                                                                                                </i>
                                                                                                <span>
                                                                                                    Blabla
                                                                                                </span>
                                                                                            </DropdownItem>
                                                                                        </DropdownMenu>
                                                                                    </UncontrolledButtonDropdown>
                                                                                </div>
                                                                            )
                                                                        }
                                                                    ]
                                                                }
                                                            ]}
                                                            defaultPageSize={10}
                                                            className="-striped -highlight"
                                                        />
                                                    </Col>
                                                </CardBody>
                                            </Collapse>
                                        </Card>
                                        <Card>
                                            <CardHeader id="headingThree">
                                                <Button
                                                    block
                                                    color="link"
                                                    className="text-left m-0 p-0"
                                                    onClick={() =>
                                                        this.toggleAccordion(2)
                                                    }
                                                    aria-expanded={
                                                        this.state.accordion[2]
                                                    }
                                                    aria-controls="collapseThree"
                                                >
                                                    <h5 className="m-0 p-0">
                                                        Edit Duration
                                                    </h5>
                                                </Button>
                                            </CardHeader>
                                            <Collapse
                                                isOpen={this.state.accordion[2]}
                                                data-parent="#accordion"
                                                id="collapseThree"
                                            >
                                                <CardBody>
                                                    <Col
                                                        lg={{ size: 12 }}
                                                        style={{ offset: 3 }}
                                                        className="pl-2"
                                                    >
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
                                                                this.props.days
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
                                                                this.props.hours
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
                                                                this.props
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
                                                                    this.props
                                                                        .days
                                                                }
                                                            </strong>{" "}
                                                            days,{" "}
                                                            <strong>
                                                                {
                                                                    this.props
                                                                        .hours
                                                                }
                                                            </strong>{" "}
                                                            hours,{" "}
                                                            <strong>
                                                                {
                                                                    this.props
                                                                        .minutes
                                                                }
                                                            </strong>{" "}
                                                            minutes.
                                                        </div>
                                                    </Col>
                                                </CardBody>
                                            </Collapse>
                                        </Card>
                                    </div>
                                </Col>
                                {/* <Col lg={4}>
                                    <ul>
                                        <li>
                                            <strong>Days:</strong>{" "}
                                            {this.state.days}
                                        </li>
                                        <li>
                                            <strong>Hours:</strong>{" "}
                                            {this.state.hours}
                                        </li>
                                        <li>
                                            <strong>Minutes:</strong>{" "}
                                            {this.state.minutes}
                                        </li>
                                    </ul>
                                </Col> */}
                            </Row>
                        </CardBody>
                    </Card>
                </VerticalTimelineElement>
            </div>
        );
    }
}
