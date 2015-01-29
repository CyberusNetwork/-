OpenBSD 5.6 (GENERIC) #5: Thu Dec 11 11:38:13 CET 2014
    root@stable-56-i386.mtier.org:/binpatchng/work-binpatch56-i386/src/sys/arch/i386/compile/GENERIC
cpu0: Geode(TM) Integrated Processor by National Semi ("Geode by NSC" 586-class) 267 MHz
cpu0: FPU,TSC,MSR,CX8,CMOV,MMX
real mem  = 133722112 (127MB)
avail mem = 119115776 (113MB)
mpath0 at root
scsibus0 at mpath0: 256 targets
mainbus0 at root
bios0 at mainbus0: AT/286+ BIOS, date 20/50/29, BIOS32 rev. 0 @ 0xf7840
pcibios0 at bios0: rev 2.0 @ 0xf0000/0x10000
pcibios0: pcibios_get_intr_routing - function not supported
pcibios0: PCI IRQ Routing information unavailable.
pcibios0: PCI bus #1 is the last bus
bios0: ROM list: 0xc8000/0x9000
cpu0 at mainbus0: (uniprocessor)
cpu0: TSC disabled
pci0 at mainbus0 bus 0: configuration mode 1 (bios)
pchb0 at pci0 dev 0 function 0 "Cyrix GXm PCI" rev 0x00
sis0 at pci0 dev 6 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:dc
nsphyter0 at sis0 phy 0: DP83815 10/100 PHY, rev. 1
sis1 at pci0 dev 7 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:dd
nsphyter1 at sis1 phy 0: DP83815 10/100 PHY, rev. 1
sis2 at pci0 dev 8 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:de
nsphyter2 at sis2 phy 0: DP83815 10/100 PHY, rev. 1
ppb0 at pci0 dev 10 function 0 "TI PCI2250" rev 0x02
pci1 at ppb0 bus 1
sis3 at pci1 dev 0 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 5, address 00:00:24:c4:a1:5c
nsphyter3 at sis3 phy 0: DP83815 10/100 PHY, rev. 1
sis4 at pci1 dev 1 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 11, address 00:00:24:c4:a1:5d
nsphyter4 at sis4 phy 0: DP83815 10/100 PHY, rev. 1
gscpcib0 at pci0 dev 18 function 0 "NS SC1100 ISA" rev 0x00
gpio0 at gscpcib0: 64 pins
"NS SC1100 SMI" rev 0x00 at pci0 dev 18 function 1 not configured
pciide0 at pci0 dev 18 function 2 "NS SCx200 IDE" rev 0x01: DMA, channel 0 wired to compatibility, channel 1 wired to compatibility
wd0 at pciide0 channel 0 drive 0: <SAMSUNG HM080HC>
wd0: 16-sector PIO, LBA48, 76319MB, 156301488 sectors
wd0(pciide0:0:0): using PIO mode 4, Ultra-DMA mode 2
geodesc0 at pci0 dev 18 function 5 "NS SC1100 X-Bus" rev 0x00: iid 6 revision 3 wdstatus 0
ohci0 at pci0 dev 19 function 0 "Compaq USB OpenHost" rev 0x08: irq 11, version 1.0, legacy support
isa0 at gscpcib0
isadma0 at isa0
com0 at isa0 port 0x3f8/8 irq 4: ns16550a, 16 byte fifo
com0: console
com1 at isa0 port 0x2f8/8 irq 3: ns16550a, 16 byte fifo
pckbc0 at isa0 port 0x60/5
pckbd0 at pckbc0 (kbd slot)
pckbc0: using irq 1 for kbd slot
wskbd0 at pckbd0: console keyboard
pcppi0 at isa0 port 0x61
spkr0 at pcppi0
nsclpcsio0 at isa0 port 0x2e/2: NSC PC87366 rev 9: GPIO VLM TMS
gpio1 at nsclpcsio0: 29 pins
gscsio0 at isa0 port 0x15c/2: SC1100 SIO rev 1:
npx0 at isa0 port 0xf0/16: reported by CPUID; using exception 16
usb0 at ohci0: USB revision 1.0
uhub0 at usb0 "Compaq OHCI root hub" rev 1.00/1.00 addr 1
vscsi0 at root
scsibus1 at vscsi0: 256 targets
softraid0 at root
scsibus2 at softraid0: 256 targets
root on wd0a (570e8f3d64bd1f52.a) swap on wd0b dump on wd0b
WARNING: / was not properly unmounted
OpenBSD 5.6 (GENERIC) #5: Thu Dec 11 11:38:13 CET 2014
    root@stable-56-i386.mtier.org:/binpatchng/work-binpatch56-i386/src/sys/arch/i386/compile/GENERIC
cpu0: Geode(TM) Integrated Processor by National Semi ("Geode by NSC" 586-class) 267 MHz
cpu0: FPU,TSC,MSR,CX8,CMOV,MMX
real mem  = 133722112 (127MB)
avail mem = 119115776 (113MB)
mpath0 at root
scsibus0 at mpath0: 256 targets
mainbus0 at root
bios0 at mainbus0: AT/286+ BIOS, date 20/50/29, BIOS32 rev. 0 @ 0xf7840
pcibios0 at bios0: rev 2.0 @ 0xf0000/0x10000
pcibios0: pcibios_get_intr_routing - function not supported
pcibios0: PCI IRQ Routing information unavailable.
pcibios0: PCI bus #1 is the last bus
bios0: ROM list: 0xc8000/0x9000
cpu0 at mainbus0: (uniprocessor)
cpu0: TSC disabled
pci0 at mainbus0 bus 0: configuration mode 1 (bios)
pchb0 at pci0 dev 0 function 0 "Cyrix GXm PCI" rev 0x00
sis0 at pci0 dev 6 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:dc
nsphyter0 at sis0 phy 0: DP83815 10/100 PHY, rev. 1
sis1 at pci0 dev 7 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:dd
nsphyter1 at sis1 phy 0: DP83815 10/100 PHY, rev. 1
sis2 at pci0 dev 8 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 10, address 00:00:24:c4:f5:de
nsphyter2 at sis2 phy 0: DP83815 10/100 PHY, rev. 1
ppb0 at pci0 dev 10 function 0 "TI PCI2250" rev 0x02
pci1 at ppb0 bus 1
sis3 at pci1 dev 0 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 5, address 00:00:24:c4:a1:5c
nsphyter3 at sis3 phy 0: DP83815 10/100 PHY, rev. 1
sis4 at pci1 dev 1 function 0 "NS DP83815 10/100" rev 0x00, DP83816A: irq 11, address 00:00:24:c4:a1:5d
nsphyter4 at sis4 phy 0: DP83815 10/100 PHY, rev. 1
gscpcib0 at pci0 dev 18 function 0 "NS SC1100 ISA" rev 0x00
gpio0 at gscpcib0: 64 pins
"NS SC1100 SMI" rev 0x00 at pci0 dev 18 function 1 not configured
pciide0 at pci0 dev 18 function 2 "NS SCx200 IDE" rev 0x01: DMA, channel 0 wired to compatibility, channel 1 wired to compatibility
wd0 at pciide0 channel 0 drive 0: <SAMSUNG HM080HC>
wd0: 16-sector PIO, LBA48, 76319MB, 156301488 sectors
wd0(pciide0:0:0): using PIO mode 4, Ultra-DMA mode 2
geodesc0 at pci0 dev 18 function 5 "NS SC1100 X-Bus" rev 0x00: iid 6 revision 3 wdstatus 0
ohci0 at pci0 dev 19 function 0 "Compaq USB OpenHost" rev 0x08: irq 11, version 1.0, legacy support
isa0 at gscpcib0
isadma0 at isa0
com0 at isa0 port 0x3f8/8 irq 4: ns16550a, 16 byte fifo
com0: console
com1 at isa0 port 0x2f8/8 irq 3: ns16550a, 16 byte fifo
pckbc0 at isa0 port 0x60/5
pckbd0 at pckbc0 (kbd slot)
pckbc0: using irq 1 for kbd slot
wskbd0 at pckbd0: console keyboard
pcppi0 at isa0 port 0x61
spkr0 at pcppi0
nsclpcsio0 at isa0 port 0x2e/2: NSC PC87366 rev 9: GPIO VLM TMS
gpio1 at nsclpcsio0: 29 pins
gscsio0 at isa0 port 0x15c/2: SC1100 SIO rev 1:
npx0 at isa0 port 0xf0/16: reported by CPUID; using exception 16
usb0 at ohci0: USB revision 1.0
uhub0 at usb0 "Compaq OHCI root hub" rev 1.00/1.00 addr 1
vscsi0 at root
scsibus1 at vscsi0: 256 targets
softraid0 at root
scsibus2 at softraid0: 256 targets
root on wd0a (570e8f3d64bd1f52.a) swap on wd0b dump on wd0b
WARNING: / was not properly unmounted
