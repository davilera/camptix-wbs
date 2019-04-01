<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

/**
 * CampTix_WBS
 */
class CampTix_WBS_Booking_Form {

	private $workshops;
	private $preferred_options;
	private $number_of_options;

	public function init_hooks() {

		add_action( 'camptix_form_edit_attendee_after_questions', [ $this, 'render' ] );

	}//end init_hooks()

	public function render() {

		$this->workshops = array(
			[ 'id' => 1, 'title' => 'The big, bad content planning workshop', 'speaker' => 'Vassilena Valchanova', 'permalink' => 'https://google.es' ],
			[ 'id' => 2, 'title' => 'REST API', 'speaker' => 'Micah Wood', 'permalink' => 'https://google.es' ],
			[ 'id' => 3, 'title' => 'Design your WordPress website to be accessible and usable – WCAG standards', 'speaker' => 'Izabela Mrochen', 'permalink' => 'https://google.es' ],
			[ 'id' => 4, 'title' => 'SEO for content marketing', 'speaker' => 'Viola Eva', 'permalink' => 'https://google.es' ],
			[ 'id' => 5, 'title' => 'Pause. Think. Create.', 'speaker' => 'Dennis Hodges', 'permalink' => 'https://google.es' ],
			[ 'id' => 6, 'title' => 'Deploying a WordPress web server in minutes', 'speaker' => 'George Gkouvousis', 'permalink' => 'https://google.es' ],
		);
		$this->preferred_options = [ 5, 2 ]; // TODO
		$this->number_of_options = 2;

?>
<style>
.tix-wbs * {
	word-wrap: normal;
	word-break: normal;
}
.tix-workshops {
	margin-left: 0;
	padding: 0;
}
.tix-workshop {
	display: flex;
	padding: 0.5em 1em;
}
.tix-workshop:nth-child( even ) {
	background: #f6f6f6;
}
.tix-workshop > * {
	min-width: 2em;
}
.tix-workshop.tix-none {
	min-height: 2em;
}
.tix-workshop-title-and-speaker {
	display: flex;
	flex-direction: column;
	flex-grow: 1;
	margin-right: 1em;
	margin-bottom: 0.5em;
}
.tix-by-line {
	color: grey;
	font-size: 0.8em;
}
.tix-workshop-speaker {
	font-style: italic;
}
.tix-workshop-option {
text-align: center;
}
</style>
<?php

		$this->render_booking_form();

	}//end render()

	private function render_booking_form() {
	?>
		<tr class="tix-wbs">
			<td colspan="2">

				<h3><?php echo esc_html_x( 'Workshops', 'text', 'camptix-wbs' ); ?></h3>
				<p><?php echo esc_html_x( 'Are you interested in attending one of our workshops? Please select your preferences below (1 is the preferred option):', 'user', 'camptix-wbs' ); ?></p>

				<ul class="tix-workshops">
					<?php
						$this->render_workshops_header();
						$this->render_no_workshop();
						$this->render_workshops();
					?>
				</ul>

			</td>
		</tr>
	<?php
	}//end render_booking_form()

	private function render_workshops_header() {

		echo '<li class="tix-workshop tix-header">';
		echo '<span class="tix-workshop-title-and-speaker"></span>';

		for ( $i = 1; $i <= $this->number_of_options; ++$i ) {
			echo '<span class="tix-workshop-option">' . $i . '</span>';
		}//end for

		echo '</li>';

	}//end render_workshops_header()

	private function render_no_workshop() {

		$this->render_workshop( array(
			'id' => 0,
			'title' => _x( 'No Workshop', 'text', 'camptix-wbs' ),
			'speaker' => false,
			'permalink' => false,
		) );

	}//end render_no_workshop()

	private function render_workshops() {

		array_map( [ $this, 'render_workshop' ], $this->workshops );

	}//end render_workshops()

	private function render_workshop( $workshop ) {

		if ( empty( $workshop['id'] ) ) {
			echo '<li class="tix-workshop tix-none">';
		} else {
			echo '<li class="tix-workshop">';
		}//end if

		$this->render_workshop_title_and_speaker( $workshop );
		$this->render_options( $workshop['id'] );

		echo '</li>';

	}//end render_workshop()

	private function render_workshop_title_and_speaker( $workshop ) {

		$title     = $this->get_title( $workshop );
		$byspeaker = $this->get_by_speaker( $workshop );

		printf( '<span class="tix-workshop-title-and-speaker">%s%s</span>', $title, $byspeaker );

	}//end render_workshop_title_and_speaker()

	private function get_title( $workshop ) {

		if ( empty( $workshop['permalink'] ) ) {
			return sprintf(
				'<span class="tix-workshop-title">%s</span>',
				esc_html( $workshop['title'] )
			);
		}//end if else {

		return sprintf(
			'<a target="_blank" href="%2$s" class="tix-workshop-title">%1$s</a>',
			esc_html( $workshop['title'] ),
			esc_html( $workshop['permalink'] )
		);

	}//end get_title()

	private function get_by_speaker( $workshop ) {

		if ( empty( $workshop['speaker'] ) ) {
			return '';
		}//end if

		return sprintf(
			' <span class="tix-by-line">' . esc_html_x( 'by %s', 'text', 'camptix-wbs' ) . '</span>',
			sprintf(
				'<span class="tix-workshop-speaker">%s</span>',
				esc_html( $workshop['speaker'] )
			)
		);

	}//end get_by_speaker()

	private function render_options( $workshop_id ) {

		for ( $option_id = 0; $option_id < $this->number_of_options; ++$option_id ) {
			$this->render_option( $option_id, $workshop_id );
		}//end for

	}//end render_options()

	private function render_option( $option_id, $workshop_id ) {

		$option_value = 0;
		if ( ! empty( $this->preferred_options[ $option_id ] ) ) {
			$option_value = $this->preferred_options[ $option_id ];
		}//end if

		echo '<span class="tix-workshop-option">';
		printf(
			'<input type="radio" name="tix_workshop_preferences[%s]" value="%s" %s />',
			$option_id,
			$workshop_id,
			checked( $workshop_id, $option_value, false )
		);
		echo '</span>';

	}//end render_option()

}//end class

