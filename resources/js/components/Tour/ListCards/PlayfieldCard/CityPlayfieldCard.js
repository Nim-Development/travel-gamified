import React, { Component } from "react";
import { faCity } from "@fortawesome/free-solid-svg-icons";
import { VerticalTimelineElement } from "react-vertical-timeline-component";
import {
    Card,
    CardBody,
    CardTitle,
    UncontrolledButtonDropdown,
    CardHeader,
    DropdownToggle,
    DropdownMenu,
    DropdownItem,
    Col,
    Row
} from "reactstrap";
import Tooltip from "rc-tooltip";
import Slider, { createSliderWithTooltip } from "rc-slider";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const SliderWithTooltip = createSliderWithTooltip(Slider);

export default class CityPlayfieldCard extends Component {
    constructor(props) {
        super(props);

        this.state = {
            days: 0,
            hours: 0,
            minutes: 0
        };

        this.handleDurationSliderDays = this.handleDurationSliderDays.bind(
            this
        );
        this.handleDurationSliderHours = this.handleDurationSliderHours.bind(
            this
        );
        this.handleDurationSliderMinutes = this.handleDurationSliderMinutes.bind(
            this
        );
    }

    handleDurationSliderDays = value => {
        console.log(`Days: ${value}`);
        this.setState({
            ...this.state,
            days: value
        });
    };
    handleDurationSliderHours = value => {
        console.log(`Hours: ${value}`);
        this.setState({
            ...this.state,
            hours: value
        });
    };
    handleDurationSliderMinutes = value => {
        console.log(`Minutes: ${value}`);
        this.setState({
            ...this.state,
            minutes: value
        });
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
                        <div className="timeline-icon border-success bg-success">
                            <FontAwesomeIcon
                                icon={faCity}
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
                                <Col lg={8}>
                                    <SliderWithTooltip
                                        tipFormatter={v => `${v} Days`}
                                        tipProps={{
                                            prefixCls: "rc-slider-tooltip",
                                            placement: "top"
                                        }}
                                        className="mb-2"
                                        min={0}
                                        max={20}
                                        value={this.state.days}
                                        onChange={this.handleDurationSliderDays}
                                    />
                                    <SliderWithTooltip
                                        tipFormatter={v => `${v} Hours`}
                                        tipProps={{
                                            prefixCls: "rc-slider-tooltip",
                                            placement: "top"
                                        }}
                                        className="mb-2"
                                        min={0}
                                        max={24}
                                        value={this.state.hours}
                                        onChange={
                                            this.handleDurationSliderHours
                                        }
                                    />
                                    <SliderWithTooltip
                                        tipFormatter={v => `${v} Minutes`}
                                        tipProps={{
                                            prefixCls: "rc-slider-tooltip",
                                            placement: "top"
                                        }}
                                        className="mb-2"
                                        min={0}
                                        step={5}
                                        max={60}
                                        defaultValue={this.state.minutes}
                                        onChange={
                                            this.handleDurationSliderMinutes
                                        }
                                    />
                                </Col>
                                <Col lg={4}>
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
                                </Col>
                            </Row>
                        </CardBody>
                    </Card>
                </VerticalTimelineElement>
            </div>
        );
    }
}
