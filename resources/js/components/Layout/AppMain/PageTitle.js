import React, { Component } from "react";
import cx from "classnames";

import TitleComponent1 from "./PageTitleExamples/Variation1";
import TitleComponent2 from "./PageTitleExamples/Variation2";
import TitleComponent3 from "./PageTitleExamples/Variation3";

class PageTitle extends Component {
    randomize(myArray) {
        return myArray[Math.floor(Math.random() * myArray.length)];
    }

    render() {
        let { enablePageTitleActions, heading, icon, subheading } = this.props;

        var arr = [
            <TitleComponent1 />,
            <TitleComponent2 />,
            <TitleComponent3 />
        ];

        return (
            <div className="app-page-title">
                <div className="page-title-wrapper">
                    <div className="page-title-heading">
                        <div className={cx("page-title-icon")}>
                            <i className={icon} />
                        </div>
                        <div>
                            {heading}
                            <div className={cx("page-title-subheading")}>
                                {subheading}
                            </div>
                        </div>
                    </div>
                    <div
                        className={cx("page-title-actions ", {
                            "d-none": !enablePageTitleActions
                        })}
                    >
                        {this.randomize(arr)}
                    </div>
                </div>
            </div>
        );
    }
}

export default PageTitle;
