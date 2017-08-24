export class StudentPermit {
	constructor(
		public studentPermitId: number,
		public studentPermitApplicationId: number,
		public studentPermitSwipeId: number,
		public studentPermitPlacardId: number,
		public studentPermitCheckOutDate: string,
		public studentPermitCheckInDate: string
	) {}
}